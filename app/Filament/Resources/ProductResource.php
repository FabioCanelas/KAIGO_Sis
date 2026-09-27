<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $modelLabel = 'Producto';
    protected static ?string $pluralModelLabel = 'Productos';
    protected static ?string $navigationLabel = 'Productos';


    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Categoría')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                        if ($operation === 'create' && !empty($state)) {
                            $category = \App\Models\Category::find($state);
                            if ($category) {
                                $prefix = strtoupper(substr($category->name, 0, 3));
                                $count = \App\Models\Product::where('code', 'like', $prefix . '-%')->count();
                                $nextNumber = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
                                $set('code', $prefix . '-' . $nextNumber);
                            }
                        }
                    }),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Marca')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del Producto')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                        if ($operation === 'create' && !empty($state)) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('code')
                    ->label('Código (SKU)')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('$')
                    ->required(),
                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('min_stock')
                    ->label('Stock Mínimo')
                    ->numeric()
                    ->default(3)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Producto Activo')
                    ->default(true),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Destacado'),
                    Forms\Components\Repeater::make('images') // 'images' es el nombre de la relación en tu modelo Product
                    ->relationship()
                    ->label('Galería de Imágenes')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Sube tu Imagen')
                            ->image() // Le dice a Filament que solo acepte imágenes
                            ->directory('productos') // Crea una carpeta "productos" donde se guardarán
                            ->required(),
                            
                        Forms\Components\Toggle::make('is_primary')
                            ->label('Â¿Es la imagen principal del producto?')
                            ->default(false),
                    ])
                    ->addActionLabel('Agregar otra imagen') // El texto del botón para sumar más fotos
                    ->columnSpanFull(), // Para que ocupe todo el ancho de la pantalla

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images.image_path')
                    ->label('Foto')
                    ->limit(1)
                    ->circular(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Marca')
                    ->searchable() 
                    ->sortable()
                    ->default('Sin Marca')
                    ->toggleable(isToggledHiddenByDefault: true), 
                Tables\Columns\TextColumn::make('average_cost')
                    ->label('Costo')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record) => $record->stock <= $record->min_stock ? 'danger' : null)
                    ->weight(fn ($record) => $record->stock <= $record->min_stock ? 'bold' : null),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filtrar por Categoría')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('add_stock')
                    ->label('Stock')
                    ->icon('heroicon-m-plus-circle')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad a ingresar al inventario')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->stock = $record->stock + $data['quantity'];
                        $record->save();
                    }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
