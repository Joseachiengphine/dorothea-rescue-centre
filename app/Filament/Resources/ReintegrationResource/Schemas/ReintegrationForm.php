<?php

namespace App\Filament\Resources\ReintegrationResource\Schemas;

use App\Models\Child;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ReintegrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Reintegration Form')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Child Details')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make('Child Information')
                                    ->schema([
                                        Forms\Components\Select::make('child_id')
                                            ->label('Select Child')
                                            ->options(function () {
                                                return Child::all()->pluck('full_name', 'id');
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if ($state) {
                                                    $child = Child::find($state);
                                                    if ($child) {
                                                        $set('admission_number', $child->admission?->admission_number);
                                                        $set('child_age', $child->date_of_birth ? $child->date_of_birth->age : null);
                                                        $set('date_of_admission', $child->admission?->date_of_admission);
                                                    }
                                                }
                                            }),
                                        
                                        Forms\Components\TextInput::make('reintegration_number')
                                            ->label('Reintegration Number')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->default(fn () => 'REINT-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT)),
                                        
                                        Forms\Components\TextInput::make('admission_number')
                                            ->label('Admission Number')
                                            ->disabled()
                                            ->dehydrated(false),
                                        
                                        Forms\Components\TextInput::make('child_age')
                                            ->label('Age')
                                            ->numeric()
                                            ->suffix('years')
                                            ->disabled()
                                            ->dehydrated(false),
                                        
                                        Forms\Components\DatePicker::make('date_of_admission')
                                            ->label('Date of Admission')
                                            ->disabled()
                                            ->dehydrated(false),
                                        
                                        Forms\Components\DatePicker::make('date_of_exit')
                                            ->label('Date of Exit')
                                            ->required()
                                            ->default(now()),
                                        
                                        Forms\Components\Textarea::make('reasons_for_exit')
                                            ->label('Reasons for Exit')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(3),
                            ]),
                        
                        Tab::make('Exit Destination')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Section::make('Receiving Person Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('receiving_person_name')
                                            ->label('Name of Receiving Person')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\Select::make('relationship_to_child')
                                            ->label('Relationship to Child')
                                            ->required()
                                            ->options([
                                                'Parent' => 'Parent',
                                                'Guardian' => 'Guardian',
                                                'Relative' => 'Relative',
                                                'Foster Parent' => 'Foster Parent',
                                                'Institution' => 'Institution',
                                                'Other' => 'Other',
                                            ]),
                                        
                                        Forms\Components\TextInput::make('receiving_person_telephone')
                                            ->label('Telephone')
                                            ->tel()
                                            ->maxLength(20),
                                        
                                        Forms\Components\Textarea::make('receiving_person_address')
                                            ->label('Address')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\DatePicker::make('receiving_person_signature_date')
                                            ->label('Signature Date')
                                            ->required()
                                            ->default(now()),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Reintegration Agreement')
                            ->icon('heroicon-o-document-check')
                            ->schema([
                                Section::make('Agreement Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('parent_guardian_name')
                                            ->label('Parent/Guardian Name')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\DatePicker::make('parent_guardian_signature_date')
                                            ->label('Signature Date')
                                            ->required()
                                            ->default(now()),
                                        
                                        Forms\Components\Textarea::make('reintegration_agreement_text')
                                            ->label('Agreement Text')
                                            ->rows(5)
                                            ->columnSpanFull()
                                            ->default('I, the undersigned parent/guardian, agree to receive the above-named child and undertake to provide proper care, protection, and support. I understand my responsibilities and commit to ensuring the child\'s welfare and development.'),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Authorization')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Section::make('Authorization Details')
                                    ->schema([
                                        Forms\Components\TextInput::make('authorizing_person_name')
                                            ->label('Authorizing Person')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('authorizing_person_designation')
                                            ->label('Designation')
                                            ->required()
                                            ->maxLength(255),
                                        
                                        Forms\Components\DatePicker::make('authorization_date')
                                            ->label('Authorization Date')
                                            ->required()
                                            ->default(now()),
                                        
                                        Forms\Components\Toggle::make('official_stamp_applied')
                                            ->label('Official Stamp Applied')
                                            ->default(false),
                                        
                                        Forms\Components\Textarea::make('comments_remarks')
                                            ->label('Comments/Remarks')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        
                        Tab::make('Follow-up & Support')
                            ->icon('heroicon-o-calendar-days')
                            ->schema([
                                Section::make('Reintegration Support')
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->label('Status')
                                            ->required()
                                            ->options([
                                                'Planned' => 'Planned',
                                                'In Progress' => 'In Progress',
                                                'Completed' => 'Completed',
                                                'Cancelled' => 'Cancelled',
                                            ])
                                            ->default('Planned'),
                                        
                                        Forms\Components\Select::make('reintegration_type')
                                            ->label('Reintegration Type')
                                            ->required()
                                            ->options([
                                                'Family Reunion' => 'Family Reunion',
                                                'Kinship Care' => 'Kinship Care',
                                                'Foster Care' => 'Foster Care',
                                                'Independent Living' => 'Independent Living',
                                                'Other' => 'Other',
                                            ]),
                                        
                                        Forms\Components\DatePicker::make('first_follow_up_date')
                                            ->label('First Follow-up Date')
                                            ->required()
                                            ->default(now()->addDays(7)),
                                        
                                        Forms\Components\Textarea::make('follow_up_plan')
                                            ->label('Follow-up Plan')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull()
                                            ->default('Regular home visits will be conducted to monitor the child\'s adjustment and well-being. Support services will be provided as needed.'),
                                        
                                        Forms\Components\Textarea::make('success_indicators')
                                            ->label('Success Indicators')
                                            ->rows(3)
                                            ->columnSpanFull()
                                            ->default('Child shows positive adjustment, maintains school attendance, demonstrates healthy relationships with family/caregivers, and exhibits overall well-being.'),
                                        
                                        Forms\Components\Textarea::make('support_services_provided')
                                            ->label('Support Services Provided')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                    ]),
            ]);
    }
}