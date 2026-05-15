<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReintegrationResource\Pages\CreateReintegration;
use App\Filament\Resources\ReintegrationResource\Pages\EditReintegration;
use App\Filament\Resources\ReintegrationResource\Pages\ListReintegrations;
use App\Filament\Resources\ReintegrationResource\Pages\ViewReintegration;
use App\Filament\Resources\ReintegrationResource\Schemas\ReintegrationForm;
use App\Filament\Resources\ReintegrationResource\Tables\ReintegrationsTable;
use App\Models\Reintegration;
use BackedEnum;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReintegrationResource extends Resource
{
    protected static ?string $model = Reintegration::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Reintegrations';

    protected static ?string $modelLabel = 'Reintegration';

    protected static ?string $pluralModelLabel = 'Reintegrations';

    protected static string|null|\UnitEnum $navigationGroup = 'Reintegration';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'reintegration_number';

    public static function form(Schema $schema): Schema
    {
        return ReintegrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReintegrationsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Reintegration Information')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Child Details')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make('Child Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('reintegration_number')
                                            ->label('Reintegration Number')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('child_name')
                                            ->label('Child Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('admission_number')
                                            ->label('Admission Number'),
                                        Infolists\Components\TextEntry::make('child_age')
                                            ->label('Age')
                                            ->suffix(' years'),
                                        Infolists\Components\TextEntry::make('date_of_admission')
                                            ->label('Date of Admission')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('date_of_exit')
                                            ->label('Date of Exit')
                                            ->date('d/m/Y')
                                            ->color('success'),
                                        Infolists\Components\TextEntry::make('reasons_for_exit')
                                            ->label('Reasons for Exit')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ])
                                    ->columns(3),
                            ]),
                        
                        Tab::make('Exit Destination')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Receiving Person Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('receiving_person_name')
                                            ->label('Name of Receiving Person')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('relationship_to_child')
                                            ->label('Relationship to Child')
                                            ->badge()
                                            ->color('info'),
                                        Infolists\Components\TextEntry::make('receiving_person_telephone')
                                            ->label('Telephone')
                                            ->icon('heroicon-o-phone'),
                                        Infolists\Components\TextEntry::make('receiving_person_address')
                                            ->label('Address')
                                            ->columnSpanFull(),
                                        Infolists\Components\TextEntry::make('receiving_person_signature_date')
                                            ->label('Signature Date')
                                            ->date('d/m/Y'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Reintegration Agreement')
                            ->icon('heroicon-o-document-check')
                            ->schema([
                                Section::make('Agreement Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('parent_guardian_name')
                                            ->label('Parent/Guardian Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('parent_guardian_signature_date')
                                            ->label('Signature Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('reintegration_agreement_text')
                                            ->label('Agreement Text')
                                            ->columnSpanFull()
                                            ->markdown()
                                            ->placeholder('Standard reintegration agreement'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Authorization')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Section::make('Authorization Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('authorizing_person_name')
                                            ->label('Authorizing Person')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('authorizing_person_designation')
                                            ->label('Designation')
                                            ->badge(),
                                        Infolists\Components\TextEntry::make('authorization_date')
                                            ->label('Authorization Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\IconEntry::make('official_stamp_applied')
                                            ->label('Official Stamp Applied')
                                            ->boolean(),
                                        Infolists\Components\TextEntry::make('comments_remarks')
                                            ->label('Comments/Remarks')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Follow-up & Support')
                            ->icon('heroicon-o-calendar-days')
                            ->schema([
                                Section::make('Reintegration Support')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Planned' => 'warning',
                                                'In Progress' => 'info',
                                                'Completed' => 'success',
                                                'Cancelled' => 'danger',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('reintegration_type')
                                            ->label('Reintegration Type')
                                            ->badge()
                                            ->color('info'),
                                        Infolists\Components\TextEntry::make('first_follow_up_date')
                                            ->label('First Follow-up Date')
                                            ->date('d/m/Y'),
                                        Infolists\Components\TextEntry::make('follow_up_plan')
                                            ->label('Follow-up Plan')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('success_indicators')
                                            ->label('Success Indicators')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('support_services_provided')
                                            ->label('Support Services Provided')
                                            ->columnSpanFull()
                                            ->markdown(),
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
            'index' => ListReintegrations::route('/'),
            'create' => CreateReintegration::route('/create'),
            'view' => ViewReintegration::route('/{record}'),
            'edit' => EditReintegration::route('/{record}/edit'),
        ];
    }
}
