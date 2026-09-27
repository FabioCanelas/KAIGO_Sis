<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockMovementResource\Pages;
use App\Filament\Resources\StockMovementResource\RelationManagers;
use App\Models\StockMovement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockMovementResource extends Resource
{
    protected static ?string $model = StockMovement::class;

    protected static ?string $modelLabel = 'Movimiento';
    protected static ?string $pluralModelLabel = 'Movimientos';
    protected static ?string $navigationLabel = 'Ajustes de Stock';


    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipo')
                    ->colors([
                        'success' => fn ($state) => in_array($state, ['in', 'adjustment_add']),
                        'danger' => fn ($state) => in_array($state, ['out', 'adjustment_remove']),
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'in' => 'Ingreso (+)',
                        'out' => 'Salida (-)',
                        'adjustment_add' => 'Ajuste (+)',
                        'adjustment_remove' => 'Ajuste (-)',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // No actions (read only)
            ])
            ->bulkActions([
                // No bulk actions
            ])
            ->headerActions([
                Tables\Actions\Action::make('ajuste_manual')
                    ->label('Ajuste Manual')
                    ->icon('heroicon-o-adjustments-vertical')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('product_id')
                            ->label('Producto')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->label('Tipo de Ajuste')
                            ->options([
                                'adjustment_add' => 'Agregar (+)',
                                'adjustment_remove' => 'Quitar (-)'
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\TextInput::make('reason')
                            ->label('Motivo')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->action(function (array $data) {
                        $product = \App\Models\Product::find($data['product_id']);
                        if ($data['type'] === 'adjustment_add') {
                            $product->stock += $data['quantity'];
                        } else {
                            $product->stock -= $data['quantity'];
                        }
                        $product->save();
                
                        \App\Models\StockMovement::create([
                            'product_id' => $data['product_id'],
                            'type' => $data['type'],
                            'quantity' => $data['quantity'],
                            'reason' => $data['reason'],
                        ]);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Ajuste realizado')
                            ->success()
                            ->send();
                    })
            ]);
    }

    
    public static function canCreate(): bool
    {
        return false;
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
            'index' => Pages\ListStockMovements::route('/'),
            'create' => Pages\CreateStockMovement::route('/create'),
            'edit' => Pages\EditStockMovement::route('/{record}/edit'),
        ];
    }
}
