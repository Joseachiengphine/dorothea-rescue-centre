<?php

namespace App\Filament\Resources\ReintegrationResource\Pages;

use App\Filament\Resources\ReintegrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReintegrations extends ListRecords
{
    protected static string $resource = ReintegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}