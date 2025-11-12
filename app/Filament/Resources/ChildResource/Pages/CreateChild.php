<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateChild extends CreateRecord
{
    protected static string $resource = ChildResource::class;

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public function getFormMaxWidth(): ?string
    {
        return null; // Full width
    }

    protected function mutateFormActions(array $actions): array
    {
        $actions[0]?->color('success');
        return $actions;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Extract nested data
        $admissionData = $data['admission'] ?? [];
        $rescueDetailData = $data['rescue_detail'] ?? [];
        $educationBackgroundData = $data['education_background'] ?? [];
        $healthRecordData = $data['health_record'] ?? [];
        $admissionReasons = $data['admission_reasons'] ?? [];
        $parents = $data['parents'] ?? [];
        $siblings = $data['siblings'] ?? [];
        $previousPlacements = $data['previous_placements'] ?? [];
        $signatures = $data['signatures'] ?? [];

        // Remove nested data from main data array
        unset(
            $data['admission'],
            $data['rescue_detail'],
            $data['education_background'],
            $data['health_record'],
            $data['admission_reasons'],
            $data['parents'],
            $data['siblings'],
            $data['previous_placements'],
            $data['signatures']
        );

        // Create the child first
        $child = static::getModel()::create($data);

        // Create admission
        if (!empty($admissionData)) {
            $admission = $child->admission()->create($admissionData);
            
            // Create admission reasons
            if (!empty($admissionReasons)) {
                foreach ($admissionReasons as $reason) {
                    $admission->admissionReasons()->create(['reason' => $reason]);
                }
            }
        }

        // Create rescue detail
        if (!empty($rescueDetailData)) {
            $child->rescueDetail()->create($rescueDetailData);
        }

        // Create education background
        if (!empty($educationBackgroundData)) {
            $child->educationBackground()->create($educationBackgroundData);
        }

        // Create health record
        if (!empty($healthRecordData)) {
            $child->healthRecord()->create($healthRecordData);
        }

        // Create parents
        if (!empty($parents)) {
            foreach ($parents as $parentData) {
                $child->parents()->create($parentData);
            }
        }

        // Create siblings
        if (!empty($siblings)) {
            foreach ($siblings as $siblingData) {
                $child->siblings()->create($siblingData);
            }
        }

        // Create previous placements
        if (!empty($previousPlacements)) {
            foreach ($previousPlacements as $placementData) {
                $child->previousPlacements()->create($placementData);
            }
        }

        // Create signatures
        if (!empty($signatures)) {
            foreach ($signatures as $signatureData) {
                $child->signatures()->create($signatureData);
            }
        }

        return $child;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}

