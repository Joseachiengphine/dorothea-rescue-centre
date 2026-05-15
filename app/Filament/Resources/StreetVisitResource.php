<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StreetVisitResource\Pages\CreateStreetVisit;
use App\Filament\Resources\StreetVisitResource\Pages\EditStreetVisit;
use App\Filament\Resources\StreetVisitResource\Pages\ListStreetVisits;
use App\Filament\Resources\StreetVisitResource\Pages\ViewStreetVisit;
use App\Filament\Resources\StreetVisitResource\Schemas\StreetVisitForm;
use App\Filament\Resources\StreetVisitResource\Tables\StreetVisitsTable;
use App\Models\StreetVisit;
use BackedEnum;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StreetVisitResource extends Resource
{
    protected static ?string $model = StreetVisit::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Street Visits';

    protected static ?string $modelLabel = 'Street Visit';

    protected static ?string $pluralModelLabel = 'Street Visits';

    protected static string|null|\UnitEnum $navigationGroup = 'Admissions';

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'visit_number';

    public static function form(Schema $schema): Schema
    {
        return StreetVisitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StreetVisitsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Street Visit Information')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Visit Details')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Visit Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('visit_number')
                                            ->label('Visit Number')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('visit_date')
                                            ->label('Visit Date')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('encounter_number')
                                            ->label('Encounter Number')
                                            ->badge()
                                            ->color('info'),
                                        Infolists\Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Active' => 'warning',
                                                'Referred' => 'success',
                                                'Lost Contact' => 'danger',
                                                'Completed' => 'success',
                                                default => 'gray',
                                            }),
                                    ])
                                    ->columns(2),
                                Section::make('Street/Base Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('street_base_name')
                                            ->label('Street/Base Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('area_in_nairobi')
                                            ->label('Area in Nairobi'),
                                        Infolists\Components\TextEntry::make('contact_person')
                                            ->label('Contact Person'),
                                        Infolists\Components\TextEntry::make('contact_tel')
                                            ->label('Contact Tel')
                                            ->icon('heroicon-o-phone'),
                                        Infolists\Components\TextEntry::make('purpose_of_visit')
                                            ->label('Purpose of Visit')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Girl Information')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make('Girl Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('girl_name')
                                            ->label('Name of Girl')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('girl_age')
                                            ->label('Age')
                                            ->suffix(' years'),
                                        Infolists\Components\TextEntry::make('duration_in_street')
                                            ->label('Duration in Street')
                                            ->columnSpanFull(),
                                        Infolists\Components\TextEntry::make('reasons_for_being_in_street')
                                            ->label('Reasons for Being in Street')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ])
                                    ->columns(2),
                                Section::make('Street Activities & Circumstances')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('activities_while_in_streets')
                                            ->label('Activities While in Streets')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('drugs_girl_is_using')
                                            ->label('Drugs Girl is Using')
                                            ->columnSpanFull()
                                            ->color('danger'),
                                        Infolists\Components\TextEntry::make('parents_guardian_name')
                                            ->label('Parents/Guardian Name'),
                                    ]),
                                Section::make('Background Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('rural_particulars')
                                            ->label('Rural Particulars')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('urban_particulars')
                                            ->label('Urban Particulars')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                            ]),
                        
                        Tab::make('Findings & Recommendations')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                Section::make('Encounter Findings')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('encounter_findings')
                                            ->label('Findings')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('recommendations')
                                            ->label('Recommendations')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                                Section::make('Follow-up Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('follow_up_notes')
                                            ->label('Follow-up Notes')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('next_visit_date')
                                            ->label('Next Visit Date')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Officer Information')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                Section::make('Officer Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('officer_name')
                                            ->label('Officer Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('officer_signature_date')
                                            ->label('Signature Date')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
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
            'index' => ListStreetVisits::route('/'),
            'create' => CreateStreetVisit::route('/create'),
            'view' => ViewStreetVisit::route('/{record}'),
            'edit' => EditStreetVisit::route('/{record}/edit'),
        ];
    }
}
