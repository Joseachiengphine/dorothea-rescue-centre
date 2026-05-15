<?php

namespace App\Filament\Resources\ReferralResource\Pages;

use App\Filament\Resources\ReferralResource;
use App\Models\Child;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewReferral extends ViewRecord
{
    protected static string $resource = ReferralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('convert_to_admission')
                ->label('Convert to Admission')
                ->icon('heroicon-o-arrow-right')
                ->color('success')
                ->visible(fn () => $this->record->status === 'Approved' && !$this->record->child_id)
                ->requiresConfirmation()
                ->modalHeading('Convert Referral to Admission')
                ->modalDescription('This will create a new child record and pre-fill the admission form with referral data.')
                ->action(function () {
                    // Create child record from referral data
                    $child = Child::create([
                        'first_name' => $this->record->child_first_name,
                        'middle_name' => $this->record->child_middle_name,
                        'surname' => $this->record->child_surname,
                        'nickname' => $this->record->child_nickname,
                        'gender' => $this->record->child_gender,
                        'date_of_birth' => $this->record->child_date_of_birth,
                        'place_of_birth_county' => $this->record->child_county,
                        'sub_county' => $this->record->child_sub_county,
                        'village' => $this->record->child_village,
                        'sub_location' => $this->record->child_sub_location,
                        'landmark' => $this->record->child_landmark,
                        'ethnicity' => $this->record->child_ethnicity,
                        'religion' => $this->record->child_religion,
                        'physical_features' => $this->record->child_physical_features,
                        'place_of_birth_known' => true,
                    ]);

                    // Link referral to child
                    $this->record->update([
                        'child_id' => $child->id,
                        'status' => 'Admitted',
                    ]);

                    Notification::make()
                        ->title('Referral converted to admission')
                        ->body('Child record created successfully. You can now complete the admission process.')
                        ->success()
                        ->send();

                    // Redirect to child edit page
                    return redirect()->route('filament.admin.resources.children.edit', $child);
                }),
            
            Action::make('update_status')
                ->label('Update Status')
                ->icon('heroicon-o-pencil-square')
                ->color('warning')
                ->form([
                    \Filament\Forms\Components\Select::make('status')
                        ->options([
                            'Pending' => 'Pending',
                            'Under Review' => 'Under Review',
                            'Approved' => 'Approved',
                            'Rejected' => 'Rejected',
                        ])
                        ->default($this->record->status)
                        ->required(),
                    \Filament\Forms\Components\Textarea::make('status_notes')
                        ->label('Status Notes')
                        ->default($this->record->status_notes)
                        ->rows(3),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => $data['status'],
                        'status_notes' => $data['status_notes'],
                        'reviewed_at' => now(),
                        'reviewed_by' => auth()->user()->name ?? 'System',
                    ]);

                    Notification::make()
                        ->title('Status updated successfully')
                        ->success()
                        ->send();
                }),
        ];
    }
}