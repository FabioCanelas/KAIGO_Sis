<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Sale;
use Carbon\Carbon;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Tendencia de Ventas (Últimos 7 Días)';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M'); // Ej: 05 Oct
            $total = Sale::whereDate('created_at', $date)->sum('total_amount');
            $data[] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Cobrado ($)',
                    'data' => $data,
                    'borderColor' => '#10b981', // green-500
                    'backgroundColor' => '#10b981',
                    'fill' => false,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
