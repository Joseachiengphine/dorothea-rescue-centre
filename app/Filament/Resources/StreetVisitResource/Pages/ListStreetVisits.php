<?php

namespace App\Filament\Resources\StreetVisitResource\Pages;

use App\Filament\Resources\StreetVisitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStreetVisits extends ListRecords
{
    protected static string $resource = StreetVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
