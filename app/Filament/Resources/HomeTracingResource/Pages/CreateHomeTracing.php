<?php

namespace App\Filament\Resources\HomeTracingResource\Pages;

use App\Filament\Resources\HomeTracingResource;
use App\Models\Child;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeTracing extends CreateRecord
{
    protected static string $resource = HomeTracingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If child_id is provided, auto-populate girl_name and girl_age
        if (isset($data['child_id']) && $data['child_id']) {
            $child = Child::find($data['child_id']);
            if ($child) {
                $data['girl_name'] = $child->full_name;
                $data['girl_age'] = $child->date_of_birth ? $child->date_of_birth->age : null;
            }
        }

        return $data;
    }

    public function mount(): void
    {
        parent::mount();

        // Pre-fill form if child_id is provided in URL
        $childId = request()->query('child_id');
        if ($childId) {
            $child = Child::find($childId);
            if ($child) {
                $this->form->fill([
                    'child_id' => $child->id,
                    'girl_name' => $child->full_name,
                    'girl_age' => $child->date_of_birth ? $child->date_of_birth->age : null,
                ]);
            }
        }
    }
}
