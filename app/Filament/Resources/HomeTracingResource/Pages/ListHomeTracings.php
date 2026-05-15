<?php

namespace App\Filament\Resources\HomeTracingResource\Pages;

use App\Filament\Resources\HomeTracingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeTracings extends ListRecords
{
    protected static string $resource = HomeTracingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
