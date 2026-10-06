<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Sale;
use Carbon\Carbon;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // HOY vs AYER
        $ventasHoy = Sale::whereDate('created_at', Carbon::today())->sum('total_amount');
        $ventasAyer = Sale::whereDate('created_at', Carbon::yesterday())->sum('total_amount');
        $diferenciaHoy = $ventasHoy - $ventasAyer;
        $porcentajeHoy = $ventasAyer > 0 ? ($diferenciaHoy / $ventasAyer) * 100 : ($ventasHoy > 0 ? 100 : 0);
        
        $iconoHoy = $diferenciaHoy >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $colorHoy = $diferenciaHoy >= 0 ? 'success' : 'danger';
        $descHoy = $diferenciaHoy >= 0 
            ? '+' . number_format($porcentajeHoy, 1) . '% respecto a ayer' 
            : number_format($porcentajeHoy, 1) . '% respecto a ayer';

        // SEMANA vs SEMANA PASADA
        $ventasSemana = Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
        $ventasSemanaPasada = Sale::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->sum('total_amount');
        $diferenciaSemana = $ventasSemana - $ventasSemanaPasada;
        $porcentajeSemana = $ventasSemanaPasada > 0 ? ($diferenciaSemana / $ventasSemanaPasada) * 100 : ($ventasSemana > 0 ? 100 : 0);

        $iconoSemana = $diferenciaSemana >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $colorSemana = $diferenciaSemana >= 0 ? 'success' : 'danger';
        $descSemana = $diferenciaSemana >= 0 
            ? '+' . number_format($porcentajeSemana, 1) . '% respecto sem. pasada' 
            : number_format($porcentajeSemana, 1) . '% respecto sem. pasada';

        // MES vs MES PASADO
        $ventasMes = Sale::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_amount');
        $ventasMesPasado = Sale::whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->sum('total_amount');
        $diferenciaMes = $ventasMes - $ventasMesPasado;
        $porcentajeMes = $ventasMesPasado > 0 ? ($diferenciaMes / $ventasMesPasado) * 100 : ($ventasMes > 0 ? 100 : 0);

        $iconoMes = $diferenciaMes >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $colorMes = $diferenciaMes >= 0 ? 'success' : 'danger';
        $descMes = $diferenciaMes >= 0 
            ? '+' . number_format($porcentajeMes, 1) . '% respecto mes pasado' 
            : number_format($porcentajeMes, 1) . '% respecto mes pasado';

        return [
            Stat::make('Ventas de Hoy', '$ ' . number_format($ventasHoy, 2))
                ->description($descHoy)
                ->descriptionIcon($iconoHoy)
                ->color($colorHoy),
                
            Stat::make('Ventas de esta Semana', '$ ' . number_format($ventasSemana, 2))
                ->description($descSemana)
                ->descriptionIcon($iconoSemana)
                ->color($colorSemana),
                
            Stat::make('Ventas del Mes Actual', '$ ' . number_format($ventasMes, 2))
                ->description($descMes)
                ->descriptionIcon($iconoMes)
                ->color($colorMes),
        ];
    }
}
