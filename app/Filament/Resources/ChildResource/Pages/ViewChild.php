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

