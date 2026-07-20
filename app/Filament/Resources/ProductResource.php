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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Categoría')
                    ->searchable()
                    ->required(),
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
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('$')
                    ->required(),
                Forms\Components\TextInput::make('stock')
                    ->label('Inventario (Stock)')
                    ->numeric()
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
                            ->label('¿Es la imagen principal del producto?')
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Marca')
                    ->searchable() 
                    ->sortable()
                    ->default('Sin Marca'), 
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),
            ])
            ->filters([
                //
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
