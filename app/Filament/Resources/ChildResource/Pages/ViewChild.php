<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewChild extends ViewRecord
{
    protected static string $resource = ChildResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create_home_tracing')
                ->label('Create Home Tracing')
                ->icon('heroicon-o-home')
                ->color('info')
                ->visible(fn () => $this->record->admission !== null)
                ->action(function () {
                    return redirect()->route('filament.admin.resources.home-tracings.create', [
                        'child_id' => $this->record->id,
                        'girl_name' => $this->record->full_name,
                        'girl_age' => $this->record->date_of_birth ? $this->record->date_of_birth->age : null,
                    ]);
                }),
            Actions\Action::make('create_reintegration')
                ->label('Create Reintegration')
                ->icon('heroicon-o-heart')
                ->color('success')
                ->visible(fn () => $this->record->admission !== null)
                ->action(function () {
                    return redirect()->route('filament.admin.resources.reintegrations.create', [
                        'child_id' => $this->record->id,
                    ]);
                }),
            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary')
                ->action(function () {
                    // Eager load all relationships
                    $this->record->load([
                        'admission.admissionReasons',
                        'rescueDetail',
                        'educationBackground',
                        'healthRecord',
                        'parents',
                        'siblings',
                        'previousPlacements',
                        'signatures',
                    ]);

                    $pdf = Pdf::loadView('pdf.admission-form', [
                        'child' => $this->record,
                    ])
                        ->setPaper('a4', 'portrait')
                        ->setOption('enable-local-file-access', true);

                    $filename = 'Admission_Form_' . $this->record->first_name . '_' . $this->record->surname . '_' . now()->format('Y-m-d') . '.pdf';

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, $filename);
                }),
            Actions\EditAction::make(),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);
        
        // Eager load all relationships
        $this->record->load([
            'admission.admissionReasons',
            'rescueDetail',
            'educationBackground',
            'healthRecord',
            'parents',
            'siblings',
            'previousPlacements',
            'signatures',
        ]);
    }
}

