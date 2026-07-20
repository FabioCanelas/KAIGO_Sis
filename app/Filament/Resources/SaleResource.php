<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;


class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Point of sale';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalles de la Venta')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Cliente (Opcional)')
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('payment_method')
                            ->label('Método de Pago')
                            ->options([
                                'cash' => 'Efectivo',
                                'transfer' => 'QR',
                            ])
                            ->default('cash')
                            ->required(),
                            
                        // Este campo es "invisible", solo sirve para guardar el total en la base de datos
                        Forms\Components\Hidden::make('total_amount')->default(0),

                        // Este campo es visual, calcula el total en tiempo real sumando los items
                        Forms\Components\Placeholder::make('gran_total')
                            ->label('TOTAL A COBRAR')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                $items = $get('items') ?? [];
                                
                                foreach ($items as $item) {
                                    $total += floatval($item['price'] ?? 0) * intval($item['quantity'] ?? 0);
                                }
                                
                                $set('total_amount', $total); // Guarda el total real
                                return '$ ' . number_format($total, 2) . ' USD'; // Muestra el total bonito
                            }),
                    ])->columns(3),

                Forms\Components\Section::make('Productos (Carrito)')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship() // Magia: se conecta automáticamente a SaleItem
                            ->label('Agregar Producto')
                            ->addActionLabel('Añadir al Carrito')
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Producto')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems() // No deja elegir el mismo producto dos veces
                                    ->live(onBlur: false)
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Al elegir un producto, busca su precio en la DB y lo pone en el campo de al lado
                                        if ($state) {
                                            $producto = \App\Models\Product::find($state);
                                            $set('price', $producto ? $producto->price : 0);
                                        }
                                    }),
                                
                                Forms\Components\TextInput::make('price')
                                    ->label('Precio Unitario')
                                    ->numeric()
                                    ->required()
                                    ->readOnly(), // Evita que el cajero modifique el precio base

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Cantidad')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required()
                                    ->live(), // Actualiza el total cuando cambias la cantidad
                            ])
                            ->columns(3)
                            ->live() // Hace que el carrito sea dinámico en tiempo real
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Cliente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago')
                    ->badge()
                    ->color(fn ($state) => $state === 'cash' ? 'success' : 'info')
                    ->formatStateUsing(fn ($state) => $state === 'cash' ? 'Efectivo' : 'QR'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }

    // Esto bloquea el botón de "Editar" en toda la tabla
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
