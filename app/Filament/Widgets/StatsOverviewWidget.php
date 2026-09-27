<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $revenue30Days = Sale::where('created_at', '>=', now()->subDays(30))->sum('total_amount');
        $totalSales30Days = Sale::where('created_at', '>=', now()->subDays(30))->count();

        // Best selling product
        $topProduct = Product::select('products.name', DB::raw('SUM(sale_items.quantity) as total_sold'))
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.created_at', '>=', now()->subDays(30))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->first();

        return [
            Stat::make('Ingresos (Últimos 30 días)', 'Bs. ' . number_format($revenue30Days, 2))
                ->description('Total recaudado')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Ventas Realizadas', $totalSales30Days)
                ->description('En los últimos 30 días'),
            Stat::make('Producto Estrella', $topProduct ? $topProduct->name : 'N/A')
                ->description($topProduct ? $topProduct->total_sold . ' unidades vendidas' : 'Sin ventas recientes')
                ->color('primary'),
        ];
    }
}