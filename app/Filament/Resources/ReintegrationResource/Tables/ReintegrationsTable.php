<?php

namespace App\Filament\Resources\ReintegrationResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;

class ReintegrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reintegration_number')
                    ->label('Reintegration #')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('child_name')
                    ->label('Child Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('child_age')
                    ->label('Age')
                    ->suffix(' yrs')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('date_of_exit')
                    ->label('Exit Date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('receiving_person_name')
                    ->label('Receiving Person')
                    ->searchable()
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('relationship_to_child')
                    ->label('Relationship')
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('reintegration_type')
                    ->label('Type')
                    ->badge()
                    ->color('primary')
                    ->limit(20),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Planned' => 'warning',
                        'In Progress' => 'info',
                        'Completed' => 'success',
                        'Cancelled' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('first_follow_up_date')
                    ->label('Follow-up Date')
                    ->date('d/m/Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Planned' => 'Planned',
                        'In Progress' => 'In Progress',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ]),
                
                Tables\Filters\SelectFilter::make('reintegration_type')
                    ->label('Type')
                    ->options([
                        'Family Reunion' => 'Family Reunion',
                        'Kinship Care' => 'Kinship Care',
                        'Foster Care' => 'Foster Care',
                        'Independent Living' => 'Independent Living',
                        'Other' => 'Other',
                    ]),
                
                Tables\Filters\SelectFilter::make('relationship_to_child')
                    ->label('Relationship')
                    ->options([
                        'Parent' => 'Parent',
                        'Guardian' => 'Guardian',
                        'Relative' => 'Relative',
                        'Foster Parent' => 'Foster Parent',
                        'Institution' => 'Institution',
                        'Other' => 'Other',
                    ]),
                
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Exit Date From'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Exit Date Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('date_of_exit', '>=', $date))
                            ->when($data['until'], fn ($query, $date) => $query->whereDate('date_of_exit', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}