<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralResource\Pages\CreateReferral;
use App\Filament\Resources\ReferralResource\Pages\EditReferral;
use App\Filament\Resources\ReferralResource\Pages\ListReferrals;
use App\Filament\Resources\ReferralResource\Pages\ViewReferral;
use App\Filament\Resources\ReferralResource\Schemas\ReferralForm;
use App\Filament\Resources\ReferralResource\Tables\ReferralsTable;
use App\Models\Referral;
use BackedEnum;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReferralResource extends Resource
{
    protected static ?string $model = Referral::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationLabel = 'Referrals';
    protected static ?string $modelLabel = 'Referral';

    protected static ?string $pluralModelLabel = 'Referrals';

    protected static string|null|\UnitEnum $navigationGroup = 'Admissions';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'referral_number';

    public static function form(Schema $schema): Schema
    {
        return ReferralForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferralsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Referral Information')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Referral Details')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Referral Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('referral_number')
                                            ->label('Referral Number')
                                            ->weight('bold')
                                            ->size('lg'),
                                        Infolists\Components\TextEntry::make('referral_date')
                                            ->label('Date of Referral')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Pending' => 'warning',
                                                'Under Review' => 'info',
                                                'Approved' => 'success',
                                                'Rejected' => 'danger',
                                                'Admitted' => 'success',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('urgency_level')
                                            ->label('Urgency Level')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Low' => 'success',
                                                'Medium' => 'warning',
                                                'High' => 'danger',
                                                'Critical' => 'danger',
                                                default => 'gray',
                                            }),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Child Information')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make('Basic Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('child_full_name')
                                            ->label('Full Name')
                                            ->getStateUsing(fn (Referral $record): string => $record->child_full_name)
                                            ->weight('bold')
                                            ->size('lg')
                                            ->columnSpanFull(),
                                        Infolists\Components\TextEntry::make('child_first_name')
                                            ->label('First Name'),
                                        Infolists\Components\TextEntry::make('child_middle_name')
                                            ->label('Middle Name'),
                                        Infolists\Components\TextEntry::make('child_surname')
                                            ->label('Surname'),
                                        Infolists\Components\TextEntry::make('child_nickname')
                                            ->label('Nickname'),
                                        Infolists\Components\TextEntry::make('child_gender')
                                            ->label('Sex')
                                            ->badge(),
                                        Infolists\Components\TextEntry::make('child_date_of_birth')
                                            ->label('Date of Birth')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('child_estimated_age')
                                            ->label('Estimated Age')
                                            ->suffix(' years'),
                                        Infolists\Components\TextEntry::make('child_ethnicity')
                                            ->label('Ethnicity'),
                                        Infolists\Components\TextEntry::make('child_religion')
                                            ->label('Religion')
                                            ->badge(),
                                    ])
                                    ->columns(3),
                                Section::make('Physical Description')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('child_physical_features')
                                            ->label('Physical Features')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                                Section::make('Location Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('child_county')
                                            ->label('County'),
                                        Infolists\Components\TextEntry::make('child_sub_county')
                                            ->label('Sub County'),
                                        Infolists\Components\TextEntry::make('child_village')
                                            ->label('Village'),
                                        Infolists\Components\TextEntry::make('child_sub_location')
                                            ->label('Sub-location'),
                                        Infolists\Components\TextEntry::make('child_landmark')
                                            ->label('Landmark')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Referrer Information')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                Section::make('Referrer Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('referrer_name')
                                            ->label('Name')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('referrer_title')
                                            ->label('Title/Position'),
                                        Infolists\Components\TextEntry::make('referrer_organization')
                                            ->label('Organization'),
                                        Infolists\Components\TextEntry::make('referrer_contact')
                                            ->label('Contact')
                                            ->icon('heroicon-o-phone'),
                                        Infolists\Components\TextEntry::make('referrer_relationship_to_child')
                                            ->label('Relationship to Child'),
                                        Infolists\Components\TextEntry::make('referrer_address')
                                            ->label('Address')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Referral Details')
                            ->icon('heroicon-o-exclamation-triangle')
                            ->schema([
                                Section::make('Reason for Referral')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('reason_for_referral')
                                            ->label('Reason for Referral')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('circumstances_leading_to_referral')
                                            ->label('Circumstances Leading to Referral')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('immediate_needs')
                                            ->label('Immediate Needs')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('background_information')
                                            ->label('Background Information')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                            ]),
                        
                        Tab::make('Current Situation')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Living Situation')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('current_location')
                                            ->label('Current Location'),
                                        Infolists\Components\TextEntry::make('current_caregiver')
                                            ->label('Current Caregiver'),
                                        Infolists\Components\TextEntry::make('current_living_conditions')
                                            ->label('Living Conditions')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Health & Education')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Section::make('Health Status')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('health_status')
                                            ->label('Health Status')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                                Section::make('Education Information')
                                    ->schema([
                                        Infolists\Components\IconEntry::make('attending_school')
                                            ->label('Attending School')
                                            ->boolean(),
                                        Infolists\Components\TextEntry::make('school_name')
                                            ->label('School Name'),
                                        Infolists\Components\TextEntry::make('education_level')
                                            ->label('Education Level'),
                                    ])
                                    ->columns(3),
                            ]),
                        
                        Tab::make('Family & Assessment')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Section::make('Family Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('family_information')
                                            ->label('Family Information')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\IconEntry::make('family_tracing_attempted')
                                            ->label('Family Tracing Attempted')
                                            ->boolean(),
                                        Infolists\Components\TextEntry::make('family_tracing_details')
                                            ->label('Family Tracing Details')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
                                Section::make('Assessment & Recommendations')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('recommended_action')
                                            ->label('Recommended Action')
                                            ->columnSpanFull()
                                            ->markdown(),
                                        Infolists\Components\TextEntry::make('additional_notes')
                                            ->label('Additional Notes')
                                            ->columnSpanFull()
                                            ->markdown(),
                                    ]),
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
            'index' => ListReferrals::route('/'),
            'create' => CreateReferral::route('/create'),
            'view' => ViewReferral::route('/{record}'),
            'edit' => EditReferral::route('/{record}/edit'),
        ];
    }
}
