<?php

namespace App\Filament\Resources\StreetVisitResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StreetVisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('visit_number')
                    ->label('Visit #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('girl_name')
                    ->label('Girl Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('girl_age')
                    ->label('Age')
                    ->suffix(' years')
                    ->sortable(),
                TextColumn::make('street_base_name')
                    ->label('Street/Base')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('area_in_nairobi')
                    ->label('Area')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('encounter_number')
                    ->label('Encounter')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1st' => 'info',
                        '2nd' => 'warning',
                        '3rd' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('visit_date')
                    ->label('Visit Date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Active' => 'warning',
                        'Referred' => 'success',
                        'Lost Contact' => 'danger',
                        'Completed' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('officer_name')
                    ->label('Officer')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('next_visit_date')
                    ->label('Next Visit')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Active' => 'Active',
                        'Referred' => 'Referred',
                        'Lost Contact' => 'Lost Contact',
                        'Completed' => 'Completed',
                    ]),
                SelectFilter::make('encounter_number')
                    ->label('Encounter Number')
                    ->options([
                        '1st' => '1st Encounter',
                        '2nd' => '2nd Encounter',
                        '3rd' => '3rd Encounter',
                    ]),
                SelectFilter::make('area_in_nairobi')
                    ->label('Area')
                    ->options(function () {
                        return \App\Models\StreetVisit::distinct()
                            ->pluck('area_in_nairobi', 'area_in_nairobi')
                            ->filter()
                            ->toArray();
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('quick_status_update')
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
                            ->required(),
                        \Filament\Forms\Components\DatePicker::make('next_visit_date')
                            ->label('Next Visit Date')
                            ->displayFormat('d/m/Y')
                            ->native(false),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'next_visit_date' => $data['next_visit_date'],
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
