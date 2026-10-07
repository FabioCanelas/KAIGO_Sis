<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\SaleItem;
use App\Models\Sale;

class ProfitOverview extends BaseWidget
{


    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Total Ingresos (Sumando el total de todas las ventas)
        $ingresos = Sale::sum('total_amount');
        
        // Total Costos (Multiplicando costo unitario * cantidad vendida para todos los items)
        $costos = SaleItem::selectRaw('SUM(unit_cost * quantity) as total_cost')->value('total_cost') ?? 0;
        
        // Ganancia Neta
        $ganancia = $ingresos - $costos;

        return [
            Stat::make('Total Ingresos (Ventas)', '$ ' . number_format($ingresos, 2))
                ->description('Dinero total cobrado')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Costo de Mercadería', '$ ' . number_format($costos, 2))
                ->description('Lo que te costaron esos productos')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),
                
            Stat::make('Ganancia Neta', '$ ' . number_format($ganancia, 2))
                ->description('Tu utilidad libre')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
