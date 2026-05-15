<?php

namespace App\Filament\Widgets;

use App\Models\Child;
use App\Models\Referral;
use App\Models\StreetVisit;
use App\Models\HomeTracing;
use App\Models\Reintegration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Children', Child::count())
                ->description('Children in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Active Cases', 
                Referral::where('status', 'Active')->count() + 
                StreetVisit::where('status', 'In Progress')->count() + 
                HomeTracing::where('status', 'In Progress')->count()
            )
                ->description('Cases in progress')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger')
                ->chart([4, 8, 6, 12, 9, 15, 11]),
            
            Stat::make('Completed This Month', 
                Reintegration::where('status', 'Completed')
                    ->whereMonth('created_at', now()->month)
                    ->count() +
                HomeTracing::where('status', 'Completed')
                    ->whereMonth('created_at', now()->month)
                    ->count()
            )
                ->description('Successful outcomes')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([2, 5, 3, 8, 6, 10, 7]),
        ];
    }
}