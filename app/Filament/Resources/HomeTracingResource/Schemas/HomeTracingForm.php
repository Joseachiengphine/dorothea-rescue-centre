<?php

namespace App\Filament\Resources\HomeTracingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class HomeTracingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make('Basic Information')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Tracing Details')
                                ->schema([
                                    DatePicker::make('tracing_date')
                                        ->label('Tracing Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->default(now())
                                        ->required(),
                                    TextInput::make('tracing_number')
                                        ->label('Tracing Number')
                                        ->disabled()
                                        ->dehydrated()
                                        ->placeholder('Will be auto-generated'),
                                    Select::make('child_id')
                                        ->label('Child')
                                        ->relationship('child', 'first_name')
                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, $set) {
                                            if ($state) {
                                                $child = \App\Models\Child::find($state);
                                                if ($child) {
                                                    $set('girl_name', $child->full_name);
                                                    $set('girl_age', $child->date_of_birth ? $child->date_of_birth->age : null);
                                                }
                                            }
                                        }),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Location Information')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make('Home Location Details')
                                ->schema([
                                    TextInput::make('girl_name')
                                        ->label('Girl Name')
                                        ->required()
                                        ->maxLength(255)
                                        ->disabled()
                                        ->dehydrated()
                                        ->helperText('Auto-populated from selected child'),
                                    TextInput::make('girl_age')
                                        ->label('Age')
                                        ->numeric()
                                        ->suffix('years')
                                        ->required()
                                        ->disabled()
                                        ->dehydrated()
                                        ->helperText('Auto-populated from selected child'),
                                    TextInput::make('home_place')
                                        ->label('Home Place')
                                        ->maxLength(255),
                                    Textarea::make('landmark')
                                        ->label('Landmark')
                                        ->rows(2),
                                    TextInput::make('nearest_town')
                                        ->label('Nearest Town')
                                        ->maxLength(255),
                                    TextInput::make('nearest_school')
                                        ->label('Nearest School')
                                        ->maxLength(255),
                                    TextInput::make('nearest_church')
                                        ->label('Nearest Church')
                                        ->maxLength(255),
                                    TextInput::make('nearest_chief_name')
                                        ->label('Nearest Chief Name')
                                        ->maxLength(255),
                                    TextInput::make('nearest_chief_office')
                                        ->label('Chief Office')
                                        ->maxLength(255),
                                    TextInput::make('chief_contact')
                                        ->label('Chief Contact')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Leave Permission')
                        ->icon('heroicon-o-document-check')
                        ->schema([
                            Section::make('Permission Details')
                                ->schema([
                                    Toggle::make('permission_granted')
                                        ->label('Permission Granted')
                                        ->inline(false)
                                        ->default(false)
                                        ->live(),
                                    TextInput::make('permission_purpose')
                                        ->label('Purpose of Visit')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                    DatePicker::make('leave_from_date')
                                        ->label('From Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                    DatePicker::make('leave_to_date')
                                        ->label('To Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                    TextInput::make('leave_duration_days')
                                        ->label('Duration (Days)')
                                        ->numeric()
                                        ->suffix('days')
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                    DatePicker::make('expected_return_date')
                                        ->label('Expected Return Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                    \Filament\Forms\Components\TimePicker::make('expected_return_time')
                                        ->label('Expected Return Time')
                                        ->default('16:00')
                                        ->visible(fn (Get $get) => $get('permission_granted')),
                                ])
                                ->columns(2),
                        ]),
                    
                    Step::make('Family Assessment')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Section::make('Initial Assessment')
                                ->schema([
                                    Textarea::make('parents_first_meeting_attitude')
                                        ->label('Parents/Guardian First Meeting Attitude')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Textarea::make('purpose_of_visit')
                                        ->label('Purpose of Visit')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Textarea::make('reasons_child_went_to_streets')
                                        ->label('Reasons Why Child Went to Streets')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ])
                                ->columns(1),
                        ]),
                    
                    Step::make('Family Information')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Parents/Guardian/Relatives Information')
                                ->schema([
                                    Repeater::make('parental_guardian_relatives')
                                        ->label('Family Members')
                                        ->schema([
                                            TextInput::make('name')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('occupation')
                                                ->maxLength(255),
                                            TextInput::make('age')
                                                ->numeric()
                                                ->suffix('years'),
                                            TextInput::make('contacts')
                                                ->label('Contact Information')
                                                ->maxLength(255),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(1)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Family Member'),
                                ])
                                ->columnSpanFull(),
                            
                            Section::make('Siblings Information')
                                ->schema([
                                    Repeater::make('siblings_information')
                                        ->label('Siblings')
                                        ->schema([
                                            TextInput::make('name')
                                                ->required()
                                                ->maxLength(255),
                                            TextInput::make('occupation_class')
                                                ->label('Occupation/Class')
                                                ->maxLength(255),
                                            TextInput::make('age')
                                                ->numeric()
                                                ->suffix('years'),
                                            TextInput::make('contacts')
                                                ->label('Contact Information')
                                                ->maxLength(255),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(0)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Sibling'),
                                ])
                                ->columnSpanFull(),
                        ]),
                    
                    Step::make('Home Observation')
                        ->icon('heroicon-o-eye')
                        ->schema([
                            Section::make('Home Situation Assessment')
                                ->schema([
                                    Textarea::make('home_situation_observation')
                                        ->label('Observation of Home Situation')
                                        ->rows(6)
                                        ->columnSpanFull()
                                        ->helperText('Document living conditions, family dynamics, safety concerns, etc.'),
                                ])
                                ->columns(1),
                        ]),
                    
                    Step::make('Signatures & Status')
                        ->icon('heroicon-o-pencil-square')
                        ->schema([
                            Section::make('Staff Information')
                                ->schema([
                                    TextInput::make('staff_in_charge')
                                        ->label('Staff in Charge')
                                        ->required()
                                        ->maxLength(255),
                                    DatePicker::make('staff_signature_date')
                                        ->label('Staff Signature Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->default(now())
                                        ->required(),
                                    TextInput::make('social_worker_name')
                                        ->label('Social Worker Name')
                                        ->maxLength(255),
                                    DatePicker::make('social_worker_signature_date')
                                        ->label('Social Worker Signature Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false),
                                    TextInput::make('director_signature')
                                        ->label('Director')
                                        ->default('Sr. Caroline Ngatia')
                                        ->maxLength(255),
                                    DatePicker::make('director_signature_date')
                                        ->label('Director Signature Date')
                                        ->displayFormat('d/m/Y')
                                        ->native(false),
                                ])
                                ->columns(2),
                            
                            Section::make('Status & Follow-up')
                                ->schema([
                                    Select::make('status')
                                        ->options([
                                            'Planned' => 'Planned',
                                            'In Progress' => 'In Progress',
                                            'Completed' => 'Completed',
                                            'Cancelled' => 'Cancelled',
                                        ])
                                        ->default('Planned')
                                        ->native(false)
                                        ->required(),
                                    Select::make('outcome')
                                        ->label('Outcome')
                                        ->options([
                                            'Successful Reintegration' => 'Successful Reintegration',
                                            'Partial Success' => 'Partial Success',
                                            'Failed' => 'Failed',
                                            'Ongoing' => 'Ongoing',
                                        ])
                                        ->native(false),
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
                ])
                ->persistStepInQueryString()
                ->columnSpanFull(),
            ]);
    }
}
