<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Ingresos Totales', '$ ' . number_format(Sale::sum('total_amount'), 2))
                ->description('Dinero generado por ventas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Gráfico de línea decorativo
                ->color('success'),
                
            Stat::make('Productos en Catálogo', Product::count())
                ->description('Total de productos registrados')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),
                
            Stat::make('Categorías Activas', Category::count())
                ->description('Secciones de la tienda')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('warning'),
        ];
    }
}
