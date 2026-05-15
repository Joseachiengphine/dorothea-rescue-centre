<?php

namespace App\Filament\Resources\ReferralResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class ReferralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make('Referral Information')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Referral Details')
                                ->schema([
                                    DatePicker::make('referral_date')
                                        ->label('Date of Referral')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->default(now())
                                        ->required(),
                                    TextInput::make('referral_number')
                                        ->label('Referral Number')
                                        ->disabled()
                                        ->dehydrated()
                                        ->placeholder('Will be auto-generated'),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Child Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Basic Information')
                                ->schema([
                                    TextInput::make('child_first_name')
                                        ->label('First Name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('child_middle_name')
                                        ->label('Middle Name')
                                        ->maxLength(255),
                                    TextInput::make('child_surname')
                                        ->label('Surname')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('child_nickname')
                                        ->label('Nickname / Likes to be called')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                            
                            Section::make('Personal Details')
                                ->schema([
                                    Select::make('child_gender')
                                        ->label('Sex')
                                        ->options([
                                            'Female' => 'Female',
                                        ])
                                        ->default('Female')
                                        ->disabled()
                                        ->dehydrated()
                                        ->native(false),
                                    DatePicker::make('child_date_of_birth')
                                        ->label('Date of Birth (if known)')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->maxDate(now()),
                                    TextInput::make('child_estimated_age')
                                        ->label('Estimated Age (if DOB unknown)')
                                        ->numeric()
                                        ->suffix('years'),
                                    TextInput::make('child_ethnicity')
                                        ->label('Ethnicity')
                                        ->maxLength(255),
                                    Select::make('child_religion')
                                        ->label('Religion')
                                        ->options([
                                            'Christian' => 'Christian',
                                            'Muslim' => 'Muslim',
                                            'Hindu' => 'Hindu',
                                            'Other' => 'Other',
                                        ])
                                        ->native(false),
                                    Textarea::make('child_physical_features')
                                        ->label('Physical Features/Description')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                            
                            Section::make('Location Information')
                                ->schema([
                                    TextInput::make('child_county')
                                        ->label('County')
                                        ->maxLength(255),
                                    TextInput::make('child_sub_county')
                                        ->label('Sub County')
                                        ->maxLength(255),
                                    TextInput::make('child_village')
                                        ->label('Village')
                                        ->maxLength(255),
                                    TextInput::make('child_sub_location')
                                        ->label('Sub-location')
                                        ->maxLength(255),
                                    Textarea::make('child_landmark')
                                        ->label('Landmark (e.g. school/church/mosque/market)')
                                        ->rows(2)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Referrer Information')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Referrer Details')
                                ->schema([
                                    TextInput::make('referrer_name')
                                        ->label('Name of Referrer')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('referrer_title')
                                        ->label('Title/Position')
                                        ->maxLength(255),
                                    TextInput::make('referrer_organization')
                                        ->label('Organization/Institution')
                                        ->maxLength(255),
                                    TextInput::make('referrer_contact')
                                        ->label('Contact (Phone/Email)')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('referrer_relationship_to_child')
                                        ->label('Relationship to Child')
                                        ->maxLength(255),
                                    Textarea::make('referrer_address')
                                        ->label('Address')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Referral Details')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->schema([
                            Section::make('Reason for Referral')
                                ->schema([
                                    Textarea::make('reason_for_referral')
                                        ->label('Reason for Referral')
                                        ->required()
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Textarea::make('circumstances_leading_to_referral')
                                        ->label('Circumstances Leading to Referral')
                                        ->required()
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Textarea::make('immediate_needs')
                                        ->label('Immediate Needs')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Textarea::make('background_information')
                                        ->label('Background Information')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),
                        ]),
                    
                    Step::make('Current Situation')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Current Living Situation')
                                ->schema([
                                    TextInput::make('current_location')
                                        ->label('Current Location')
                                        ->maxLength(255),
                                    TextInput::make('current_caregiver')
                                        ->label('Current Caregiver (if any)')
                                        ->maxLength(255),
                                    Textarea::make('current_living_conditions')
                                        ->label('Current Living Conditions')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Health & Education')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('Health Status')
                                ->schema([
                                    Textarea::make('health_status')
                                        ->label('Health Status/Medical Needs')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(1),
                            
                            Section::make('Education Information')
                                ->schema([
                                    Toggle::make('attending_school')
                                        ->label('Currently Attending School?')
                                        ->inline(false)
                                        ->default(false)
                                        ->live(),
                                    TextInput::make('school_name')
                                        ->label('School Name')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('attending_school')),
                                    TextInput::make('education_level')
                                        ->label('Education Level/Class')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('attending_school')),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Family Information')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Section::make('Family Details')
                                ->schema([
                                    Textarea::make('family_information')
                                        ->label('Family Information (Parents, Siblings, etc.)')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Toggle::make('family_tracing_attempted')
                                        ->label('Has family tracing been attempted?')
                                        ->inline(false)
                                        ->default(false)
                                        ->live(),
                                    Textarea::make('family_tracing_details')
                                        ->label('Family Tracing Details')
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->visible(fn (Get $get) => $get('family_tracing_attempted')),
                                ])
                                ->columns(1),
                        ]),
                    
                    Step::make('Assessment & Recommendations')
                        ->icon('heroicon-o-clipboard-document-check')
                        ->schema([
                            Section::make('Assessment')
                                ->schema([
                                    Select::make('urgency_level')
                                        ->label('Urgency Level')
                                        ->options([
                                            'Low' => 'Low',
                                            'Medium' => 'Medium',
                                            'High' => 'High',
                                            'Critical' => 'Critical',
                                        ])
                                        ->default('Medium')
                                        ->native(false)
                                        ->required(),
                                    Textarea::make('recommended_action')
                                        ->label('Recommended Action')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Textarea::make('additional_notes')
                                        ->label('Additional Notes')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(1),
                        ]),
                ])
                ->persistStepInQueryString()
                ->columnSpanFull(),
            ]);
    }
}