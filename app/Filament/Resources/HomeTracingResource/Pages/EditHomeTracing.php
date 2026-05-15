<?php

namespace App\Filament\Resources\HomeTracingResource\Pages;

use App\Filament\Resources\HomeTracingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeTracing extends EditRecord
{
    protected static string $resource = HomeTracingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
