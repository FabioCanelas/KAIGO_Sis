<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Product;

class LowStockAlertWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->whereColumn('stock', '<=', 'min_stock')
            )
            ->heading('Alertas de Stock Bajo')
            ->description('Productos que necesitan ser reabastecidos pronto.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Producto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock Actual')
                    ->color('danger')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('min_stock')
                    ->label('Stock Mínimo'),
            ]);
    }
}