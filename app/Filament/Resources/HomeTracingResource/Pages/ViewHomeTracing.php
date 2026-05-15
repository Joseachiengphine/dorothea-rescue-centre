<?php

namespace App\Filament\Resources\HomeTracingResource\Pages;

use App\Filament\Resources\HomeTracingResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewHomeTracing extends ViewRecord
{
    protected static string $resource = HomeTracingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('update_status')
                ->label('Update Status')
                ->icon('heroicon-o-pencil-square')
                ->color('warning')
                ->form([
                    \Filament\Forms\Components\Select::make('status')
                        ->options([
                            'Planned' => 'Planned',
                            'In Progress' => 'In Progress',
                            'Completed' => 'Completed',
                            'Cancelled' => 'Cancelled',
                        ])
                        ->default($this->record->status)
                        ->required(),
                    \Filament\Forms\Components\Select::make('outcome')
                        ->label('Outcome')
                        ->options([
                            'Successful Reintegration' => 'Successful Reintegration',
                            'Partial Success' => 'Partial Success',
                            'Failed' => 'Failed',
                            'Ongoing' => 'Ongoing',
                        ])
                        ->default($this->record->outcome),
                    \Filament\Forms\Components\Textarea::make('follow_up_notes')
                        ->label('Follow-up Notes')
                        ->default($this->record->follow_up_notes)
                        ->rows(4),
                    \Filament\Forms\Components\DatePicker::make('next_visit_date')
                        ->label('Next Visit Date')
                        ->default($this->record->next_visit_date)
                        ->displayFormat('d/m/Y')
                        ->native(false),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => $data['status'],
                        'outcome' => $data['outcome'],
                        'follow_up_notes' => $data['follow_up_notes'],
                        'next_visit_date' => $data['next_visit_date'],
                    ]);

                    Notification::make()
                        ->title('Status updated successfully')
                        ->success()
                        ->send();
                }),
            
            Action::make('generate_leave_sheet')
                ->label('Generate Leave Sheet')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->visible(fn () => $this->record->permission_granted)
                ->action(function () {
                    // This would generate a PDF leave sheet
                    Notification::make()
                        ->title('Leave sheet generated')
                        ->body('Leave sheet has been prepared for printing.')
                        ->success()
                        ->send();
                }),
        ];
    }
}