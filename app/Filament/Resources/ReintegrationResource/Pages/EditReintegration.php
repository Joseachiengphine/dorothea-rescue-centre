<?php

namespace App\Filament\Resources\ReintegrationResource\Pages;

use App\Filament\Resources\ReintegrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReintegration extends EditRecord
{
    protected static string $resource = ReintegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
}