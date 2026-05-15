<?php

namespace App\Filament\Resources\StreetVisitResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class StreetVisitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make('Visit Information')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Visit Details')
                                ->schema([
                                    DatePicker::make('visit_date')
                                        ->label('Visit Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->default(now())
                                        ->required(),
                                    TextInput::make('visit_number')
                                        ->label('Visit Number')
                                        ->disabled()
                                        ->dehydrated()
                                        ->placeholder('Will be auto-generated'),
                                    Select::make('encounter_number')
                                        ->label('Encounter Number')
                                        ->options([
                                            '1st' => '1st Encounter',
                                            '2nd' => '2nd Encounter',
                                            '3rd' => '3rd Encounter',
                                        ])
                                        ->default('1st')
                                        ->native(false)
                                        ->required(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Street/Base Information')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make('Location Details')
                                ->schema([
                                    TextInput::make('street_base_name')
                                        ->label('Street/Base Name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('area_in_nairobi')
                                        ->label('Area in Nairobi')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('contact_person')
                                        ->label('Contact Person')
                                        ->maxLength(255),
                                    TextInput::make('contact_tel')
                                        ->label('Contact Tel')
                                        ->maxLength(255),
                                    Textarea::make('purpose_of_visit')
                                        ->label('Purpose of Visit (explain)')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Girl Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Girl Details')
                                ->schema([
                                    TextInput::make('girl_name')
                                        ->label('Name of the Girl')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('girl_age')
                                        ->label('Age')
                                        ->numeric()
                                        ->suffix('years'),
                                    Textarea::make('duration_in_street')
                                        ->label('Duration in the Street')
                                        ->required()
                                        ->rows(2)
                                        ->columnSpanFull(),
                                    Textarea::make('reasons_for_being_in_street')
                                        ->label('Reasons for Being in the Street')
                                        ->required()
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Street Activities & Circumstances')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->schema([
                            Section::make('Activities and Substance Use')
                                ->schema([
                                    Textarea::make('activities_while_in_streets')
                                        ->label('Activities While in the Streets')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Textarea::make('drugs_girl_is_using')
                                        ->label('Drugs the Girl is Using')
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->helperText('Please specify any substances or drugs being used'),
                                ])
                                ->columns(1),
                            
                            Section::make('Family Information')
                                ->schema([
                                    TextInput::make('parents_guardian_name')
                                        ->label('Parents/Guardian Name')
                                        ->maxLength(255),
                                ])
                                ->columns(1),
                        ]),
                    
                    Step::make('Background Information')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Section::make('Particulars')
                                ->schema([
                                    Textarea::make('rural_particulars')
                                        ->label('Rural Particulars')
                                        ->rows(4)
                                        ->columnSpanFull()
                                        ->helperText('Information about rural background, family, etc.'),
                                    Textarea::make('urban_particulars')
                                        ->label('Urban Particulars')
                                        ->rows(4)
                                        ->columnSpanFull()
                                        ->helperText('Information about urban situation, connections, etc.'),
                                ])
                                ->columns(1),
                        ]),
                    
                    Step::make('Findings & Recommendations')
                        ->icon('heroicon-o-clipboard-document-check')
                        ->schema([
                            Section::make('Encounter Results')
                                ->schema([
                                    Textarea::make('encounter_findings')
                                        ->label('Findings')
                                        ->rows(5)
                                        ->columnSpanFull()
                                        ->helperText('Document what was observed and discovered during this encounter'),
                                    Textarea::make('recommendations')
                                        ->label('Recommendations')
                                        ->rows(5)
                                        ->columnSpanFull()
                                        ->helperText('Recommended next steps and actions'),
                                ])
                                ->columns(1),
                            
                            Section::make('Follow-up Planning')
                                ->schema([
                                    Select::make('status')
                                        ->label('Status')
                                        ->options([
                                            'Active' => 'Active',
                                            'Referred' => 'Referred',
                                            'Lost Contact' => 'Lost Contact',
                                            'Completed' => 'Completed',
                                        ])
                                        ->default('Active')
                                        ->native(false)
                                        ->required(),
                                    DatePicker::make('next_visit_date')
                                        ->label('Next Visit Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false),
                                    Textarea::make('follow_up_notes')
                                        ->label('Follow-up Notes')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Officer Information')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Officer Details')
                                ->schema([
                                    TextInput::make('officer_name')
                                        ->label('Name of the Officer')
                                        ->required()
                                        ->maxLength(255),
                                    DatePicker::make('officer_signature_date')
                                        ->label('Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->default(now())
                                        ->required(),
                                ])
                                ->columns(2),
                        ]),
                ])
                ->persistStepInQueryString()
                ->columnSpanFull(),
            ]);
    }
}
