<?php

namespace App\Filament\Widgets;

use App\Models\Referral;
use App\Models\Reintegration;
use Filament\Widgets\ChartWidget;

class MonthlyTrendsChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Activity Trends';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return now()->month($month)->format('M');
        });

        $referrals = collect(range(1, 12))->map(function ($month) {
            return Referral::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        $reintegrations = collect(range(1, 12))->map(function ($month) {
            return Reintegration::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'New Referrals',
                    'data' => $referrals->toArray(),
                    'borderColor' => '#B91C1C',
                    'backgroundColor' => 'rgba(185, 28, 28, 0.1)',
                    'tension' => 0.4,
                    'borderWidth' => 3,
                    'pointBackgroundColor' => '#B91C1C',
                    'pointBorderColor' => '#FFFFFF',
                    'pointBorderWidth' => 2,
                ],
                [
                    'label' => 'Reintegrations',
                    'data' => $reintegrations->toArray(),
                    'borderColor' => '#29AB87',
                    'backgroundColor' => 'rgba(41, 171, 135, 0.1)',
                    'tension' => 0.4,
                    'borderWidth' => 3,
                    'pointBackgroundColor' => '#29AB87',
                    'pointBorderColor' => '#FFFFFF',
                    'pointBorderWidth' => 2,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'size' => 12,
                            'weight' => 'bold',
                        ],
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.1)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}