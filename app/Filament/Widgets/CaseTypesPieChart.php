<?php

namespace App\Filament\Widgets;

use App\Models\Referral;
use App\Models\StreetVisit;
use App\Models\HomeTracing;
use App\Models\Reintegration;
use Filament\Widgets\ChartWidget;

class CaseTypesPieChart extends ChartWidget
{
    protected ?string $heading = 'Case Types Distribution';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $referrals = Referral::count();
        $streetVisits = StreetVisit::count();
        $homeTracings = HomeTracing::count();
        $reintegrations = Reintegration::count();

        return [
            'datasets' => [
                [
                    'data' => [$referrals, $streetVisits, $homeTracings, $reintegrations],
                    'backgroundColor' => [
                        '#B91C1C', // Deep Red - Referrals
                        '#FFD700', // Bright Yellow - Street Visits
                        '#1E3A8A', // Navy Blue - Home Tracings
                        '#29AB87', // Jungle Green - Reintegrations
                    ],
                    'borderWidth' => 3,
                    'borderColor' => '#FFFFFF',
                ],
            ],
            'labels' => ['Referrals', 'Street Visits', 'Home Tracings', 'Reintegrations'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
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
        ];
    }
}