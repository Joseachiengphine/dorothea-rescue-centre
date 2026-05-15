<?php

namespace App\Filament\Resources\ReferralResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReferralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referral_number')
                    ->label('Referral #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('child_full_name')
                    ->label('Child Name')
                    ->getStateUsing(fn ($record) => $record->child_full_name)
                    ->searchable(['child_first_name', 'child_middle_name', 'child_surname'])
                    ->sortable(),
                TextColumn::make('referrer_name')
                    ->label('Referred By')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referral_date')
                    ->label('Referral Date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('urgency_level')
                    ->label('Urgency')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Low' => 'success',
                        'Medium' => 'warning',
                        'High' => 'danger',
                        'Critical' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Under Review' => 'info',
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        'Admitted' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Under Review' => 'Under Review',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                        'Admitted' => 'Admitted',
                    ]),
                SelectFilter::make('urgency_level')
                    ->label('Urgency Level')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                        'Critical' => 'Critical',
                    ]),
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
                                'Pending' => 'Pending',
                                'Under Review' => 'Under Review',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'reviewed_at' => now(),
                            'reviewed_by' => auth()->user()->name ?? 'System',
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