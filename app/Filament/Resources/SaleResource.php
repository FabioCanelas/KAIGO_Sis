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

    protected static ?string $modelLabel = 'Venta';
    protected static ?string $pluralModelLabel = 'Ventas';
    protected static ?string $navigationLabel = 'Punto de Venta';


    protected static ?string $navigationIcon = 'heroicon-o-banknotes';


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
                        
                        Forms\Components\TextInput::make('discount')
                            ->label('Descuento Global ($)')
                            ->numeric()
                            ->default(0)
                            ->live(onBlur: true),

                        Forms\Components\Hidden::make('total_amount')->default(0),

                        // Este campo es visual, calcula el total en tiempo real sumando los items
                        Forms\Components\Placeholder::make('gran_total')
                            ->label('TOTAL A COBRAR')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                $items = $get('items') ?? [];
                                
                                foreach ($items as $item) {
                                    $subtotal = floatval($item['price'] ?? 0) * intval($item['quantity'] ?? 0);
                                    $itemDiscount = floatval($item['discount'] ?? 0);
                                    $total += ($subtotal - $itemDiscount);
                                }

                                $globalDiscount = floatval($get('discount') ?? 0);
                                $total -= $globalDiscount;
                                $total = max(0, $total);
                                
                                $set('total_amount', $total); // Guarda el total real
                                return '$ ' . number_format($total, 2) . ' USD'; // Muestra el total bonito
                            }),
                    ])->columns(4),

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
                                    ->allowHtml()
                                    ->getOptionLabelFromRecordUsing(function (\App\Models\Product $record) {
                                        $name = $record->code ? "{$record->code} - {$record->name}" : $record->name;
                                        $image = $record->images->where('is_primary', true)->first() ?? $record->images->first();
                                        if ($image && $image->image_path) {
                                            $url = \Illuminate\Support\Facades\Storage::url($image->image_path);
                                            return "<div class='flex items-center gap-3'>
                                                        <img src='{$url}' alt='{$record->name}' style='width: 32px; height: 32px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;'>
                                                        <span>{$name}</span>
                                                    </div>";
                                        }
                                        return "<div class='flex items-center gap-3'>
                                                    <div style='width: 32px; height: 32px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #aaa; border: 1px solid #ccc;'>N/A</div>
                                                    <span>{$name}</span>
                                                </div>";
                                    })
                                    ->searchable(['name', 'code'])
                                    ->preload()
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
                                    ->live(),

                                Forms\Components\TextInput::make('discount')
                                    ->label('Descuento ($)')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->live(onBlur: true),

                            ])
                            ->columns(4)
                            ->live() // Hace que el carrito sea dinámico en tiempo real
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('USD')
                    ->sortable()
                    ->summarize(Tables\Columns\Summarizers\Sum::make()->money('USD')->label('Total')),
                Tables\Columns\TextColumn::make('discount')
                    ->label('Desc. Global')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago')
                    ->badge()
                    ->color(fn ($state) => $state === 'cash' ? 'success' : 'info')
                    ->formatStateUsing(fn ($state) => $state === 'cash' ? 'Efectivo' : 'QR'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('created_until')->label('Hasta'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = \Filament\Tables\Filters\Indicator::make('Desde: ' . \Carbon\Carbon::parse($data['created_from'])->toFormattedDateString())
                                ->removeField('created_from');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = \Filament\Tables\Filters\Indicator::make('Hasta: ' . \Carbon\Carbon::parse($data['created_until'])->toFormattedDateString())
                                ->removeField('created_until');
                        }
                        return $indicators;
                    }),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'cash' => 'Efectivo',
                        'qr' => 'QR',
                    ])
                    ->label('Método de Pago'),
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
