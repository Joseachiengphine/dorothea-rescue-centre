<?php

namespace App\Filament\Resources\StreetVisitResource\Pages;

use App\Filament\Resources\StreetVisitResource;
use App\Models\Referral;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewStreetVisit extends ViewRecord
{
    protected static string $resource = StreetVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create_referral')
                ->label('Create Referral')
                ->icon('heroicon-o-arrow-right')
                ->color('success')
                ->visible(fn () => $this->record->status === 'Active' && !$this->record->referral_id)
                ->requiresConfirmation()
                ->modalHeading('Create Referral from Street Visit')
                ->modalDescription('This will create a new referral record pre-filled with information from this street visit.')
                ->action(function () {
                    // Parse the girl's name to extract first and last names
                    $nameParts = explode(' ', trim($this->record->girl_name));
                    $firstName = $nameParts[0] ?? 'Unknown';
                    $surname = count($nameParts) > 1 ? end($nameParts) : 'Unknown';
                    $middleName = count($nameParts) > 2 ? implode(' ', array_slice($nameParts, 1, -1)) : null;

                    // Create referral record from street visit data
                    $referral = Referral::create([
                        'referral_date' => now(),
                        'child_first_name' => $firstName,
                        'child_middle_name' => $middleName,
                        'child_surname' => $surname,
                        'child_estimated_age' => $this->record->girl_age,
                        'child_gender' => 'Female',
                        'referrer_name' => $this->record->officer_name,
                        'referrer_title' => 'Street Outreach Officer',
                        'referrer_organization' => 'Dorothea Rescue Centre',
                        'referrer_contact' => 'Street Visit Program',
                        'reason_for_referral' => 'Girl identified during street visit program',
                        'circumstances_leading_to_referral' => $this->record->reasons_for_being_in_street,
                        'background_information' => "Street Visit Details:\n\nDuration in Street: " . $this->record->duration_in_street . 
                                                   "\n\nActivities: " . ($this->record->activities_while_in_streets ?? 'Not specified') .
                                                   "\n\nRural Particulars: " . ($this->record->rural_particulars ?? 'Not specified') .
                                                   "\n\nUrban Particulars: " . ($this->record->urban_particulars ?? 'Not specified'),
                        'current_location' => $this->record->street_base_name . ', ' . $this->record->area_in_nairobi,
                        'health_status' => $this->record->drugs_girl_is_using ? 'Drug use reported: ' . $this->record->drugs_girl_is_using : null,
                        'family_information' => $this->record->parents_guardian_name ? 'Parents/Guardian: ' . $this->record->parents_guardian_name : 'No family information available',
                        'urgency_level' => 'High',
                        'recommended_action' => $this->record->recommendations ?? 'Follow-up required',
                        'additional_notes' => "Created from Street Visit #" . $this->record->visit_number . " (Encounter #" . $this->record->encounter_number . ")",
                        'status' => 'Pending',
                    ]);

                    // Link street visit to referral
                    $this->record->update([
                        'referral_id' => $referral->id,
                        'status' => 'Referred',
                    ]);

                    Notification::make()
                        ->title('Referral created successfully')
                        ->body('Street visit has been converted to a referral. You can now process the referral.')
                        ->success()
                        ->send();

                    // Redirect to referral view page
                    return redirect()->route('filament.admin.resources.referrals.view', $referral);
                }),
            
            Action::make('update_encounter')
                ->label('Update Encounter')
                ->icon('heroicon-o-arrow-path')
                ->color('info')
                ->form([
                    \Filament\Forms\Components\Select::make('encounter_number')
                        ->label('Encounter Number')
                        ->options([
                            '1st' => '1st Encounter',
                            '2nd' => '2nd Encounter',
                            '3rd' => '3rd Encounter',
                        ])
                        ->default($this->record->encounter_number)
                        ->required()
                        ->helperText('Update the encounter number for follow-up visits with the same girl'),
                    \Filament\Forms\Components\Textarea::make('encounter_findings')
                        ->label('Update Findings')
                        ->default($this->record->encounter_findings)
                        ->rows(4)
                        ->helperText('Add or update findings from this encounter'),
                    \Filament\Forms\Components\Textarea::make('recommendations')
                        ->label('Update Recommendations')
                        ->default($this->record->recommendations)
                        ->rows(4)
                        ->helperText('Add or update recommendations based on this encounter'),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'encounter_number' => $data['encounter_number'],
                        'encounter_findings' => $data['encounter_findings'],
                        'recommendations' => $data['recommendations'],
                    ]);

                    Notification::make()
                        ->title('Encounter updated successfully')
                        ->body('Encounter number and details have been updated.')
                        ->success()
                        ->send();
                }),
            
            Action::make('update_status')
                ->label('Update Status')
                ->icon('heroicon-o-pencil-square')
                ->color('warning')
                ->form([
                    \Filament\Forms\Components\Select::make('status')
                        ->options([
                            'Active' => 'Active',
                            'Referred' => 'Referred',
                            'Lost Contact' => 'Lost Contact',
                            'Completed' => 'Completed',
                        ])
                        ->default($this->record->status)
                        ->required(),
                    \Filament\Forms\Components\Textarea::make('follow_up_notes')
                        ->label('Follow-up Notes')
                        ->default($this->record->follow_up_notes)
                        ->rows(3),
                    \Filament\Forms\Components\DatePicker::make('next_visit_date')
                        ->label('Next Visit Date')
                        ->default($this->record->next_visit_date)
                        ->displayFormat('d/m/Y')
                        ->native(false),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => $data['status'],
                        'follow_up_notes' => $data['follow_up_notes'],
                        'next_visit_date' => $data['next_visit_date'],
                    ]);

                    Notification::make()
                        ->title('Status updated successfully')
                        ->success()
                        ->send();
                }),
        ];
    }
}