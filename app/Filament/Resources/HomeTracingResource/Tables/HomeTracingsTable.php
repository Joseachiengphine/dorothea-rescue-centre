<?php

namespace App\Filament\Resources\HomeTracingResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class HomeTracingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tracing_number')
                    ->label('Tracing #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('child.full_name')
                    ->label('Child Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tracing_date')
                    ->label('Tracing Date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('home_place')
                    ->label('Home Place')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nearest_town')
                    ->label('Nearest Town')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permission_granted')
                    ->label('Permission')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Granted' : 'Pending')
                    ->color(fn (bool $state): string => $state ? 'success' : 'warning')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Planned' => 'warning',
                        'In Progress' => 'info',
                        'Completed' => 'success',
                        'Cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('outcome')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Successful Reintegration' => 'success',
                        'Partial Success' => 'warning',
                        'Failed' => 'danger',
                        'Ongoing' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('staff_in_charge')
                    ->label('Staff in Charge')
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
                        'Planned' => 'Planned',
                        'In Progress' => 'In Progress',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('outcome')
                    ->options([
                        'Successful Reintegration' => 'Successful Reintegration',
                        'Partial Success' => 'Partial Success',
                        'Failed' => 'Failed',
                        'Ongoing' => 'Ongoing',
                    ]),
                SelectFilter::make('permission_granted')
                    ->label('Permission Status')
                    ->options([
                        '1' => 'Granted',
                        '0' => 'Pending',
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
                                'Planned' => 'Planned',
                                'In Progress' => 'In Progress',
                                'Completed' => 'Completed',
                                'Cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        \Filament\Forms\Components\Select::make('outcome')
                            ->label('Outcome')
                            ->options([
                                'Successful Reintegration' => 'Successful Reintegration',
                                'Partial Success' => 'Partial Success',
                                'Failed' => 'Failed',
                                'Ongoing' => 'Ongoing',
                            ]),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'outcome' => $data['outcome'],
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
