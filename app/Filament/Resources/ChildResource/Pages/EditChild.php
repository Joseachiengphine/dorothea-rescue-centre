<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChild extends EditRecord
{
    protected static string $resource = ChildResource::class;

    protected array $nestedData = [];

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public function getFormMaxWidth(): ?string
    {
        return null; // Full width
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $child = $this->record;

        // Load admission data
        if ($child->admission) {
            $data['admission'] = $child->admission->toArray();
            $data['admission_reasons'] = $child->admission->admissionReasons->pluck('reason')->toArray();
        }

        // Load rescue detail
        if ($child->rescueDetail) {
            $data['rescue_detail'] = $child->rescueDetail->toArray();
        }

        // Load education background
        if ($child->educationBackground) {
            $data['education_background'] = $child->educationBackground->toArray();
        }

        // Load health record
        if ($child->healthRecord) {
            $data['health_record'] = $child->healthRecord->toArray();
        }

        // Load parents
        $data['parents'] = $child->parents->toArray();

        // Load siblings
        $data['siblings'] = $child->siblings->toArray();

        // Load previous placements
        $data['previous_placements'] = $child->previousPlacements->toArray();

        // Load signatures
        $data['signatures'] = $child->signatures->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

        // Store nested data for later processing
        $this->nestedData = [
            'admission' => $admissionData,
            'rescue_detail' => $rescueDetailData,
            'education_background' => $educationBackgroundData,
            'health_record' => $healthRecordData,
            'admission_reasons' => $admissionReasons,
            'parents' => $parents,
            'siblings' => $siblings,
            'previous_placements' => $previousPlacements,
            'signatures' => $signatures,
        ];

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

        return $data;
    }

    protected function afterSave(): void
    {
        $child = $this->record;
        $nestedData = $this->nestedData ?? [];

        // Update or create admission
        if (!empty($nestedData['admission'])) {
            $admission = $child->admission()->updateOrCreate(
                ['child_id' => $child->id],
                $nestedData['admission']
            );

            // Sync admission reasons
            if (isset($nestedData['admission_reasons'])) {
                $admission->admissionReasons()->delete();
                foreach ($nestedData['admission_reasons'] as $reason) {
                    $admission->admissionReasons()->create(['reason' => $reason]);
                }
            }
        }

        // Update or create rescue detail
        if (!empty($nestedData['rescue_detail'])) {
            $child->rescueDetail()->updateOrCreate(
                ['child_id' => $child->id],
                $nestedData['rescue_detail']
            );
        }

        // Update or create education background
        if (!empty($nestedData['education_background'])) {
            $child->educationBackground()->updateOrCreate(
                ['child_id' => $child->id],
                $nestedData['education_background']
            );
        }

        // Update or create health record
        if (!empty($nestedData['health_record'])) {
            $child->healthRecord()->updateOrCreate(
                ['child_id' => $child->id],
                $nestedData['health_record']
            );
        }

        // Sync parents
        if (isset($nestedData['parents'])) {
            $child->parents()->delete();
            foreach ($nestedData['parents'] as $parentData) {
                $child->parents()->create($parentData);
            }
        }

        // Sync siblings
        if (isset($nestedData['siblings'])) {
            $child->siblings()->delete();
            foreach ($nestedData['siblings'] as $siblingData) {
                $child->siblings()->create($siblingData);
            }
        }

        // Sync previous placements
        if (isset($nestedData['previous_placements'])) {
            $child->previousPlacements()->delete();
            foreach ($nestedData['previous_placements'] as $placementData) {
                $child->previousPlacements()->create($placementData);
            }
        }

        // Sync signatures
        if (isset($nestedData['signatures'])) {
            $child->signatures()->delete();
            foreach ($nestedData['signatures'] as $signatureData) {
                $child->signatures()->create($signatureData);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}

