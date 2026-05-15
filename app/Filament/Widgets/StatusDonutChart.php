<?php

namespace App\Filament\Widgets;

use App\Models\Referral;
use App\Models\StreetVisit;
use App\Models\HomeTracing;
use App\Models\Reintegration;
use Filament\Widgets\ChartWidget;

class StatusDonutChart extends ChartWidget
{
    protected ?string $heading = 'Case Status Distribution';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $planned = Referral::where('status', 'Planned')->count() + 
                  StreetVisit::where('status', 'Planned')->count() + 
                  HomeTracing::where('status', 'Planned')->count() + 
                  Reintegration::where('status', 'Planned')->count();

        $inProgress = Referral::where('status', 'In Progress')->count() + 
                     StreetVisit::where('status', 'In Progress')->count() + 
                     HomeTracing::where('status', 'In Progress')->count() + 
                     Reintegration::where('status', 'In Progress')->count();

        $completed = Referral::where('status', 'Completed')->count() + 
                    StreetVisit::where('status', 'Completed')->count() + 
                    HomeTracing::where('status', 'Completed')->count() + 
                    Reintegration::where('status', 'Completed')->count();

        return [
            'datasets' => [
                [
                    'data' => [$planned, $inProgress, $completed],
                    'backgroundColor' => [
                        '#FFD700', // Bright Yellow - Planned
                        '#1E3A8A', // Navy Blue - In Progress  
                        '#29AB87', // Jungle Green - Completed
                    ],
                    'borderWidth' => 3,
                    'borderColor' => '#FFFFFF',
                ],
            ],
            'labels' => ['Planned', 'In Progress', 'Completed'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
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
            'maintainAspectRatio' => false,
            'cutout' => '60%',
        ];
    }
}