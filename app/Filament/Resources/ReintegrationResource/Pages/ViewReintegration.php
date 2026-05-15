<?php

namespace App\Filament\Resources\ReintegrationResource\Pages;

use App\Filament\Resources\ReintegrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReintegration extends ViewRecord
{
    protected static string $resource = ReintegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}