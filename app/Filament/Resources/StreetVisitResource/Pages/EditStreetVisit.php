<?php

namespace App\Filament\Resources\StreetVisitResource\Pages;

use App\Filament\Resources\StreetVisitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStreetVisit extends EditRecord
{
    protected static string $resource = StreetVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
