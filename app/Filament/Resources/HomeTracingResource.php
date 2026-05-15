<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeTracingResource\Pages\CreateHomeTracing;
use App\Filament\Resources\HomeTracingResource\Pages\EditHomeTracing;
use App\Filament\Resources\HomeTracingResource\Pages\ListHomeTracings;
use App\Filament\Resources\HomeTracingResource\Pages\ViewHomeTracing;
use App\Filament\Resources\HomeTracingResource\Schemas\HomeTracingForm;
use App\Filament\Resources\HomeTracingResource\Tables\HomeTracingsTable;
use App\Models\HomeTracing;
use BackedEnum;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeTracingResource extends Resource
{
    protected static ?string $model = HomeTracing::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Home Tracing';

    protected static ?string $modelLabel = 'Home Tracing';

    protected static ?string $pluralModelLabel = 'Home Tracings';

    protected static string|null|\UnitEnum $navigationGroup = 'Reintegration';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'tracing_number';

    public static function form(Schema $schema): Schema
    {
        return HomeTracingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeTracingsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Home Tracing Information')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic Information')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Tracing Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('tracing_number')
                                            ->label('Tracing Number')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('tracing_date')
                                            ->label('Tracing Date')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('child.full_name')
                                            ->label('Child Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Planned' => 'warning',
                                                'In Progress' => 'info',
                                                'Completed' => 'success',
                                                'Cancelled' => 'danger',
                                                default => 'gray',
                                            }),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Location & Contact')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Home Location')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('home_place')
                                            ->label('Home Place'),
                                        Infolists\Components\TextEntry::make('landmark')
                                            ->label('Landmark'),
                                        Infolists\Components\TextEntry::make('nearest_town')
                                            ->label('Nearest Town'),
                                        Infolists\Components\TextEntry::make('nearest_school')
                                            ->label('Nearest School'),
                                        Infolists\Components\TextEntry::make('nearest_church')
                                            ->label('Nearest Church'),
                                        Infolists\Components\TextEntry::make('nearest_chief_name')
                                            ->label('Nearest Chief Name'),
                                        Infolists\Components\TextEntry::make('nearest_chief_office')
                                            ->label('Chief Office'),
                                        Infolists\Components\TextEntry::make('chief_contact')
                                            ->label('Chief Contact')
                                            ->icon('heroicon-o-phone'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Leave Permission')
                            ->icon('heroicon-o-document-check')
                            ->schema([
                                Section::make('Permission Details')
                                    ->schema([
                                        Infolists\Components\IconEntry::make('permission_granted')
                                            ->label('Permission Granted')
                                            ->boolean(),
                                        Infolists\Components\TextEntry::make('permission_purpose')
                                            ->label('Purpose'),
                                        Infolists\Components\TextEntry::make('leave_from_date')
                                            ->label('From Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('leave_to_date')
                                            ->label('To Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('leave_duration_days')
                                            ->label('Duration')
                                            ->suffix(' days'),
                                        Infolists\Components\TextEntry::make('expected_return_date')
                                            ->label('Expected Return Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('expected_return_time')
                                            ->label('Expected Return Time')
                                            ->time('H:i'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Family Information')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Section::make('Family Assessment')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('parents_first_meeting_attitude')
                                            ->label('Parents First Meeting Attitude')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('reasons_child_went_to_streets')
                                            ->label('Reasons Child Went to Streets')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('home_situation_observation')
                                            ->label('Home Situation Observation')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                            ]),
                        
                        Tab::make('Signatures & Status')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                Section::make('Signatures')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('staff_in_charge')
                                            ->label('Staff in Charge'),
                                        Infolists\Components\TextEntry::make('staff_signature_date')
                                            ->label('Staff Signature Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('social_worker_name')
                                            ->label('Social Worker'),
                                        Infolists\Components\TextEntry::make('social_worker_signature_date')
                                            ->label('Social Worker Signature Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('director_signature')
                                            ->label('Director'),
                                        Infolists\Components\TextEntry::make('director_signature_date')
                                            ->label('Director Signature Date')
                                            ->date('d/m/Y'),
                                    ])
                                    ->columns(2),
                                Section::make('Outcome')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('outcome')
                                            ->label('Outcome')
                                            ->badge()
                                            ->color(fn (?string $state): string => match ($state) {
                                                'Successful Reintegration' => 'success',
                                                'Partial Success' => 'warning',
                                                'Failed' => 'danger',
                                                'Ongoing' => 'info',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('follow_up_notes')
                                            ->label('Follow-up Notes')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('next_visit_date')
                                            ->label('Next Visit Date')
                                            ->date('d/m/Y'),
                                    ])
                                    ->columns(2),
                            ]),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeTracings::route('/'),
            'create' => CreateHomeTracing::route('/create'),
            'view' => ViewHomeTracing::route('/{record}'),
            'edit' => EditHomeTracing::route('/{record}/edit'),
        ];
    }
}
