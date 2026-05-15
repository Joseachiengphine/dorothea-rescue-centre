<?php

namespace App\Filament\Resources\ReintegrationResource\Pages;

use App\Filament\Resources\ReintegrationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReintegration extends CreateRecord
{
    protected static string $resource = ReintegrationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
}