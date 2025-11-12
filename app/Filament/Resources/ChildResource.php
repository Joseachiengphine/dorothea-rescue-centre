<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Models\Child;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChildResource extends Resource
{
    protected static ?string $model = Child::class;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Children';

    protected static ?string $modelLabel = 'Child';

    protected static ?string $pluralModelLabel = 'Children';

    protected static string|null|\UnitEnum $navigationGroup = 'Admissions';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make('Child Information')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Basic Information')
                                ->schema([
                                    TextInput::make('first_name')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(1),
                                    TextInput::make('middle_name')
                                        ->maxLength(255)
                                        ->columnSpan(1),
                                    TextInput::make('surname')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(1),
                                    TextInput::make('nickname')
                                        ->label('Nickname / Likes to be called')
                                        ->maxLength(255)
                                        ->columnSpan(1),
                                ])
                                ->columns(2),
                            Section::make('Personal Details')
                                ->schema([
                                    Select::make('gender')
                                        ->label('Sex')
                                        ->options([
                                            'Female' => 'Female',
                                        ])
                                        ->default('Female')
                                        ->disabled()
                                        ->dehydrated()
                                        ->native(false),
                                    DatePicker::make('date_of_birth')
                                        ->label('Date of Birth (DOB)')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->minDate(now()->subYears(4)->startOfYear())
                                        ->maxDate(now()),
                                    TextInput::make('ethnicity')
                                        ->maxLength(255),
                                    Select::make('religion')
                                        ->options([
                                            'Christian' => 'Christian',
                                            'Muslim' => 'Muslim',
                                            'Hindu' => 'Hindu',
                                            'Other' => 'Other',
                                        ])
                                        ->native(false),
                                    TextInput::make('complexion')
                                        ->maxLength(255),
                                    Textarea::make('physical_features')
                                        ->label('Distinguish Physical Features')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                            Section::make('Place of Birth')
                                ->schema([
                                    TextInput::make('place_of_birth_county')
                                        ->label('County')
                                        ->maxLength(255),
                                    TextInput::make('sub_county')
                                        ->maxLength(255),
                                    TextInput::make('village')
                                        ->maxLength(255),
                                    TextInput::make('sub_location')
                                        ->label('Sub-location')
                                        ->maxLength(255),
                                    Textarea::make('landmark')
                                        ->label('Landmark (e.g. school/church/mosque/market)')
                                        ->rows(2)
                                        ->columnSpanFull(),
                                    Toggle::make('place_of_birth_known')
                                        ->label('Not known')
                                        ->default(true)
                                        ->inline(false),
                                ])
                                ->columns(2),
                        ]),
                    Step::make('Admission Details')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Admission Information')
                                ->schema([
                                    DatePicker::make('admission.date_of_admission')
                                        ->label('Date of Admission')
                                        ->displayFormat('d/m/Y')
                                        ->native(false),
                                    TextInput::make('admission.age_at_admission')
                                        ->label('Age of Child at Admission')
                                        ->numeric()
                                        ->suffix('years'),
                                    Select::make('admission.other_forms_of_admission')
                                        ->label('Other Forms of Admission')
                                        ->options([
                                            'Self-referral' => 'Self-referral',
                                            'Abandoned at CCI' => 'Abandoned at CCI',
                                        ])
                                        ->native(false),
                                ])
                                ->columns(2),
                            Section::make('Admission Order')
                                ->schema([
                                    Toggle::make('admission.admission_order_issued')
                                        ->label('Was admission order issued?')
                                        ->inline(false)
                                        ->default(false),
                                    TextInput::make('admission.committal_order_no')
                                        ->label('Committal Order #')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('admission.admission_order_issued')),
                                   DatePicker::make('admission.date_of_committal')
                                        ->label('Date of Committal')
                                        ->displayFormat('d/m/Y')
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('admission.admission_order_issued')),
                                    TextInput::make('admission.ob_number')
                                        ->label('O.B Number')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('admission.admission_order_issued')),
                                ])
                                ->columns(2),
                            Section::make('Referral Information')
                                ->schema([
                                    TextInput::make('admission.referred_by_name')
                                        ->label('Who referred the child? (Name)')
                                        ->maxLength(255),
                                    TextInput::make('admission.referred_by_title')
                                        ->label('Title')
                                        ->maxLength(255),
                                    TextInput::make('admission.relationship_to_child')
                                        ->label('Relationship to the child')
                                        ->maxLength(255),
                                    TextInput::make('admission.contact')
                                        ->label('Contact')
                                        ->maxLength(255),
                                    TextInput::make('admission.location')
                                        ->label('Location')
                                        ->maxLength(255),
                                    Textarea::make('admission.address_of_current_care_provider')
                                        ->label('Address of Current Care Provider')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                            Section::make('Current Care')
                                ->schema([
                                    Select::make('admission.current_care_type')
                                        ->label('Current Alternative Care Placement Type')
                                        ->options([
                                            'Kinship care' => 'Kinship care',
                                            'Foster care' => 'Foster care',
                                            'Temporary shelter' => 'Temporary shelter',
                                            'CCI' => 'CCI',
                                            'SCI' => 'SCI',
                                            'Supported child-Headed household' => 'Supported child-Headed household',
                                            'Supported Independent Living' => 'Supported Independent Living',
                                            'Kafaalah' => 'Kafaalah',
                                            'Guardianship' => 'Guardianship',
                                            'Other' => 'Other',
                                        ])
                                        ->native(false),
                                    Textarea::make('admission.current_care_address')
                                        ->label('Current Care Address')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    TextInput::make('admission.registration_status')
                                        ->label('Registration Status')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                            Section::make('Reasons for Admission')
                                ->schema([
                                    CheckboxList::make('admission_reasons')
                                        ->label('Please tick all applicable')
                                        ->options([
                                            'School/Education access' => 'School/Education access',
                                            'Poverty/family vulnerability' => 'Poverty/family vulnerability',
                                            'Child abandoned' => 'Child abandoned',
                                            'Child on the street' => 'Child on the street',
                                            'Special need (disability)' => 'Special need (disability)',
                                            'Orphan' => 'Orphan',
                                            'Separated/unaccompanied' => 'Separated/unaccompanied',
                                            'Child of imprisoned parent' => 'Child of imprisoned parent',
                                            'Abuse or neglect at home' => 'Abuse or neglect at home',
                                            'HIV & AIDS or other chronic illness' => 'HIV & AIDS or other chronic illness',
                                            'Child victim of human trafficking' => 'Child victim of human trafficking',
                                            'Child lost and found' => 'Child lost and found',
                                            'Other' => 'Other',
                                        ])
                                        ->columns(2)
                                        ->descriptions([
                                            'School/Education access' => 'Limited or no access to education',
                                            'Poverty/family vulnerability' => 'Family unable to provide basic needs',
                                            'Child abandoned' => 'Child left without care',
                                        ])
                                        ->bulkToggleable(),
                                ]),
                        ]),
                    Step::make('Rescue Details')
                        ->icon('heroicon-o-shield-check')
                        ->schema([
                            Section::make('Rescue Information')
                                ->schema([
                                    TextInput::make('rescue_detail.found_by')
                                        ->label('Name of institution/Person that found the child')
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Textarea::make('rescue_detail.found_location')
                                        ->label('Where was the child found?')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    DatePicker::make('rescue_detail.date_found')
                                        ->label('When was the child found?')
                                        ->displayFormat('d/m/Y')
                                        ->native(false),
                                ])
                                ->columns(2),
                            Section::make('Case History')
                                ->schema([
                                    Textarea::make('rescue_detail.case_history')
                                        ->label('Child Case History')
                                        ->rows(8)
                                        ->columnSpanFull(),
                                ]),
                            Section::make('Previous Placements')
                                ->schema([
                                    Repeater::make('previous_placements')
                                        ->label('Previous History of Placement')
                                        ->schema([
                                            Select::make('placement_type')
                                                ->label('Type of Placement')
                                                ->options([
                                                    'CCI' => 'CCI',
                                                    'Kinship' => 'Kinship',
                                                    'Foster' => 'Foster',
                                                    'Kafaalah' => 'Kafaalah',
                                                    'Guardianship' => 'Guardianship',
                                                    'Temporary' => 'Temporary',
                                                    'Other' => 'Other (e.g. SIL or supported child headed household)',
                                                ])
                                                ->native(false)
                                                ->required(),
                                            DatePicker::make('from')
                                                ->label('From')
                                                ->displayFormat('d/m/Y')
                                                ->native(false),
                                            DatePicker::make('to')
                                                ->label('To')
                                                ->displayFormat('d/m/Y')
                                                ->native(false),
                                            Textarea::make('notes')
                                                ->label('Notes')
                                                ->rows(2)
                                                ->columnSpanFull()
                                                ->helperText('If the child has been in several types of care, please indicate the types and/or names of CCIs'),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(0)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['placement_type'] ?? null),
                                ]),
                        ]),
                    Step::make('Education Background')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('Previous School')
                                ->schema([
                                   Toggle::make('education_background.previously_attended')
                                        ->label('Previously attended school?')
                                        ->inline(false)
                                        ->default(false)
                                        ->live(),
                                    TextInput::make('education_background.previous_school_name')
                                        ->label('Name of School')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.previously_attended')),
                                    TextInput::make('education_background.previous_school_location')
                                        ->label('Location of School')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.previously_attended')),
                                    Select::make('education_background.previous_school_type')
                                        ->label('Type')
                                        ->options([
                                            'Public' => 'Public',
                                            'Private' => 'Private',
                                        ])
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('education_background.previously_attended')),
                                    Select::make('education_background.previous_school_day_boarding')
                                        ->label('Day/Boarding')
                                        ->options([
                                            'Day' => 'Day',
                                            'Boarding' => 'Boarding',
                                        ])
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('education_background.previously_attended')),
                                ])
                                ->columns(2),
                            Section::make('Current School')
                                ->schema([
                                    Toggle::make('education_background.currently_attending')
                                        ->label('Child currently attending school?')
                                        ->inline(false)
                                        ->default(false)
                                        ->live(),
                                    TextInput::make('education_background.current_school_name')
                                        ->label('Name of School')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                    TextInput::make('education_background.current_school_location')
                                        ->label('Location of School')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                    Select::make('education_background.current_school_type')
                                        ->label('Type')
                                        ->options([
                                            'Public' => 'Public',
                                            'Private' => 'Private',
                                        ])
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                    Select::make('education_background.current_school_day_boarding')
                                        ->label('Day/Boarding')
                                        ->options([
                                            'Day' => 'Day',
                                            'Boarding' => 'Boarding',
                                        ])
                                        ->native(false)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                    TextInput::make('education_background.education_level')
                                        ->label('Current Education Level')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                    TextInput::make('education_background.current_education_level_detail')
                                        ->label('ECD/Grade/Form/Vocational/Tertiary')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('education_background.currently_attending')),
                                ])
                                ->columns(2),
                        ]),
                    Step::make('Family Information')
                        ->icon('heroicon-o-users')
                        ->schema([
                            Section::make('Parents')
                                ->schema([
                                    Repeater::make('parents')
                                        ->schema([
                                            Select::make('type')
                                                ->label('Parent Type')
                                                ->options([
                                                    'Mother' => 'Mother',
                                                    'Father' => 'Father',
                                                ])
                                                ->native(false)
                                                ->required()
                                                ->disabled(fn ($context) => $context === 'edit'),
                                            TextInput::make('name')
                                                ->label('Name')
                                                ->maxLength(255),
                                            TextInput::make('other_names')
                                                ->label('Other Names')
                                                ->maxLength(255),
                                            TextInput::make('last_known_location')
                                                ->label('Last Known Location')
                                                ->maxLength(255),
                                            TextInput::make('contact')
                                                ->maxLength(255),
                                            TextInput::make('occupation_or_education')
                                                ->label('Occupation/Education/Employment')
                                                ->maxLength(255),
                                            Select::make('status')
                                                ->label('Alive (Yes/No/Not known)')
                                                ->options([
                                                    'Alive' => 'Alive',
                                                    'Deceased' => 'Deceased',
                                                    'Not known' => 'Not known',
                                                ])
                                                ->native(false),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(0)
                                        ->minItems(0)
                                        ->maxItems(2)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => ($state['type'] ?? 'Parent') . ($state['name'] ? ' - ' . $state['name'] : '')),
                                ]),
                            Section::make('Siblings')
                                ->schema([
                                    Repeater::make('siblings')
                                        ->schema([
                                            TextInput::make('name')
                                                ->maxLength(255),
                                            TextInput::make('last_known_location')
                                                ->label('Last Known Location')
                                                ->maxLength(255),
                                            TextInput::make('occupation_or_education')
                                                ->label('Occupation/Education/Employment')
                                                ->maxLength(255),
                                            TextInput::make('age')
                                                ->numeric()
                                                ->suffix('years'),
                                            TextInput::make('contact')
                                                ->maxLength(255),
                                            Toggle::make('living_with_child')
                                                ->label('Living with child now in this form of care?')
                                                ->inline(false)
                                                ->default(false),
                                            Toggle::make('admitted_elsewhere')
                                                ->label('Admitted into care elsewhere?')
                                                ->inline(false)
                                                ->default(false),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(0)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Sibling'),
                                ]),
                        ]),
                    Step::make('Health Status')
                        ->icon('heroicon-o-heart')
                        ->schema([
                            Section::make('Health Information')
                                ->schema([
                                    Toggle::make('health_record.hospitalized')
                                        ->label('Have you been hospitalized?')
                                        ->inline(false)
                                        ->default(false),
                                    TextInput::make('health_record.illness')
                                        ->label('If yes, what were you suffering from?')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get) => $get('health_record.hospitalized')),
                                    Textarea::make('health_record.health_notes')
                                        ->label('Other Health Notes')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),
                        ]),
                    Step::make('Signatures')
                        ->icon('heroicon-o-pencil-square')
                        ->action(
                            Action::make('submit')
                                ->label('Save Admission')
                                ->icon('heroicon-o-check-circle')
                        )
                        ->schema([
                            Section::make('Sign-off')
                                ->description('Capture signatures from all required parties')
                                ->schema([
                                    Repeater::make('signatures')
                                        ->schema([
                                            Select::make('role')
                                                ->options([
                                                    'Child' => "Girl's name (Child)",
                                                    'Social Worker' => 'Social Worker',
                                                    'Director' => 'Director (Dorothea Rescue Centre)',
                                                ])
                                                ->native(false)
                                                ->required()
                                                ->disabled(fn ($context) => $context === 'edit'),
                                            TextInput::make('name')
                                                ->maxLength(255),
                                            DatePicker::make('signed_date')
                                                ->label('Date')
                                                ->displayFormat('d/m/Y')
                                                ->native(false)
                                                ->default(now()),
                                            FileUpload::make('signature_file')
                                                ->label('Signature')
                                                ->directory('signatures')
                                                ->image()
                                                ->maxSize(5120)
                                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                                ->imageEditor()
                                                ->columnSpanFull(),
                                        ])
                                        ->columns(2)
                                        ->defaultItems(3)
                                        ->minItems(3)
                                        ->maxItems(3)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['role'] ?? 'Signature'),
                                ]),
                        ]),
                ])
                ->persistStepInQueryString()
                ->nextAction(
                    fn (Action $action) => $action->label('Next step'),
                )
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('surname')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->getStateUsing(fn (Child $record): string => $record->full_name)
                    ->searchable(['first_name', 'middle_name', 'surname'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('admission.date_of_admission')
                    ->label('Admission Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('gender'),
                Filter::make('date_of_admission')
                    ->schema([
                        DatePicker::make('admitted_from')
                            ->label('Admitted From'),
                        DatePicker::make('admitted_until')
                            ->label('Admitted Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['admitted_from'],
                                fn (Builder $query, $date): Builder => $query->whereHas('admission', fn ($q) => $q->whereDate('date_of_admission', '>=', $date)),
                            )
                            ->when(
                                $data['admitted_until'],
                                fn (Builder $query, $date): Builder => $query->whereHas('admission', fn ($q) => $q->whereDate('date_of_admission', '<=', $date)),
                            );
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
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Child Information')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Personal Info')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Section::make('Name Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('full_name')
                                            ->label('Full Name')
                                            ->getStateUsing(fn (Child $record): string => $record->full_name)
                                            ->weight('bold')
                                            ->size('lg')
//                                            ->color('primary')
                                            ->columnSpanFull(),
                                        Infolists\Components\TextEntry::make('first_name')
                                            ->label('First Name')
//                                            ->color('primary')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('middle_name')
//                                            ->color('primary')
                                            ->label('Middle Name'),
                                        Infolists\Components\TextEntry::make('surname')
                                            ->label('Surname')
//                                            ->color('primary')
                                            ->weight('bold'),
                                        Infolists\Components\TextEntry::make('nickname')
                                            ->label('Nickname / Likes to be called')
                                            ->icon('heroicon-o-user-circle')
//                                            ->color('primary')
                                            ->placeholder('No nickname')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Personal Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('gender')
                                            ->label('Sex')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'Female' => 'pink',
                                                default => 'gray',
                                            }),
                                        Infolists\Components\TextEntry::make('date_of_birth')
                                            ->label('Date of Birth')
                                            ->date('d/m/Y')
//                                            ->color('primary')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('age')
                                            ->label('Age')
//                                            ->color('primary')
                                            ->getStateUsing(fn (Child $record): ?string => $record->date_of_birth ? $record->date_of_birth->age . ' years' : null)
                                            ->icon('heroicon-o-clock'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Background Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('ethnicity')
                                            ->icon('heroicon-o-globe-alt')
//                                            ->color('primary')
                                            ->placeholder('Not specified'),
                                        Infolists\Components\TextEntry::make('religion')
                                            ->badge()
                                            ->icon('heroicon-o-heart')
//                                            ->color('primary')
                                            ->placeholder('Not specified'),
                                        Infolists\Components\TextEntry::make('complexion')
                                            ->icon('heroicon-o-paint-brush')
//                                            ->color('primary')
                                            ->placeholder('Not specified'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Physical Features')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('physical_features')
                                            ->label('Distinguish Physical Features')
                                            ->placeholder('No distinguishing features noted')
                                            ->columnSpanFull()
                                            ->markdown()
                                            ->prose(),
                                    ]),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Place of Birth')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Location Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('place_of_birth_county')
//                                            ->color('info')
                                            ->label('County'),
                                        Infolists\Components\TextEntry::make('sub_county')
//                                            ->color('info')
                                            ->label('Sub County'),
                                        Infolists\Components\TextEntry::make('village')
//                                            ->color('info')
                                        ,
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Additional Location Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('sub_location')
//                                            ->color('info')
                                            ->label('Sub-location'),
                                        Infolists\Components\TextEntry::make('landmark')
                                            ->label('Landmark')
                                            ->color('info')
                                            ->placeholder('No landmark specified'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2),
                                Section::make('Status')
                                    ->schema([
                                        Infolists\Components\IconEntry::make('place_of_birth_known')
                                            ->label('Place of Birth Known')
                                            ->boolean()
                                            ->color(fn ($state): string => $state ? 'success' : 'danger'),
                                    ]),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Admission Details')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Admission Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('admission.date_of_admission')
                                            ->label('Date of Admission')
//                                            ->color('info')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('admission.age_at_admission')
//                                            ->color('info')
                                            ->label('Age at Admission'),
                                        Infolists\Components\TextEntry::make('admission.other_forms_of_admission')
                                            ->label('Other Forms of Admission')
                                            ->badge()
                                            ->color('warning'),
                                        Infolists\Components\IconEntry::make('admission.admission_order_issued')
                                            ->label('Admission Order Issued')
                                            ->boolean()
                                            ->color(fn ($state): string => $state ? 'success' : 'danger'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(4),
                                Section::make('Order Details')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('admission.committal_order_no')
//                                            ->color('info')
                                            ->label('Committal Order #'),
                                        Infolists\Components\TextEntry::make('admission.date_of_committal')
//                                            ->color('info')
                                            ->label('Date of Committal')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('admission.ob_number')
                                            ->color('info')
                                            ->label('O.B Number'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Referral Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('admission.referred_by_name')
//                                            ->color('primary')
                                            ->label('Referred By'),
                                        Infolists\Components\TextEntry::make('admission.referred_by_title')
//                                            ->color('primary')
                                            ->label('Title'),
                                        Infolists\Components\TextEntry::make('admission.relationship_to_child')
//                                            ->color('primary')
                                            ->label('Relationship to Child'),
                                        Infolists\Components\TextEntry::make('admission.contact')
//                                            ->color('primary')
                                            ->icon('heroicon-o-phone'),
                                        Infolists\Components\TextEntry::make('admission.location')
//                                            ->color('primary')
                                            ->icon('heroicon-o-map-pin'),
                                        Infolists\Components\TextEntry::make('admission.address_of_current_care_provider')
                                            ->label('Address of Current Care Provider')
//                                            ->color('primary')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(3),
                                Section::make('Current Care')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('admission.current_care_type')
                                            ->label('Current Care Type')
                                            ->badge()
                                            ->color('info'),
                                        Infolists\Components\TextEntry::make('admission.current_care_address')
//                                            ->color('info')
                                            ->label('Current Care Address'),
                                        Infolists\Components\TextEntry::make('admission.registration_status')
                                            ->label('Registration Status')
                                            ->badge()
                                            ->color('success'),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2),
                                Section::make('Reasons for Admission')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('admission_reasons_list')
                                            ->label('Admission reasons')
                                            ->getStateUsing(function (Child $record): string {
                                                if (!$record->admission || !$record->admission->admissionReasons || $record->admission->admissionReasons->isEmpty()) {
                                                    return 'No reasons specified';
                                                }
                                                return $record->admission->admissionReasons
                                                    ->pluck('reason')
                                                    ->map(fn ($reason) => "• {$reason}")
                                                    ->join("\n\n");
                                            })
                                            ->color('warning')
                                            ->columnSpanFull()
                                            ->markdown()
                                            ->prose()
                                            ->size('base')
                                            ->weight('normal'),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Rescue & Case History')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Section::make('Rescue Information')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('rescueDetail.found_by')
                                            ->color('info')
                                            ->label('Found By'),
                                        Infolists\Components\TextEntry::make('rescueDetail.date_found')
//                                            ->color('primary')
                                            ->label('Date Found')
                                            ->date('d/m/Y')
                                            ->icon('heroicon-o-calendar'),
                                        Infolists\Components\TextEntry::make('rescueDetail.found_location')
                                            ->label('Found Location')
                                            ->icon('heroicon-o-map-pin')
//                                            ->color('primary')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2),
                                Section::make('Case History')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('rescueDetail.case_history')
                                            ->label('Case History')
//                                            ->color('primary')
                                            ->columnSpanFull()
                                            ->markdown()
                                            ->prose(),
                                    ]),
                                Section::make('Previous Placements')
                                    ->schema([
                                        Infolists\Components\RepeatableEntry::make('previousPlacements')
                                            ->label('')
                                            ->schema([
                                                Infolists\Components\TextEntry::make('placement_type')
                                                    ->label('Type')
                                                    ->badge()
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('from')
                                                    ->label('From')
                                                    ->date('d/m/Y')
                                                    ->icon('heroicon-o-calendar')
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('to')
                                                    ->label('To')
                                                    ->date('d/m/Y')
                                                    ->icon('heroicon-o-calendar')
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('notes')
                                                    ->label('Notes')
//                                                    ->color('info')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columnSpanFull()
                                            ->columns(3),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Education')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Section::make('Previous School')
                                    ->schema([
                                        Infolists\Components\IconEntry::make('educationBackground.previously_attended')
                                            ->label('Previously Attended School')
                                            ->boolean()
                                            ->color(fn ($state): string => $state ? 'success' : 'danger'),
                                        Infolists\Components\TextEntry::make('educationBackground.previous_school_name')
                                            ->label('School Name')
                                            ->color('info'),
                                        Infolists\Components\TextEntry::make('educationBackground.previous_school_location')
                                            ->color('info')
                                            ->label('Location')
                                            ->icon('heroicon-o-map-pin'),
                                        Infolists\Components\TextEntry::make('educationBackground.previous_school_type')
//                                            ->color('info')
                                            ->label('School Type')
                                            ->badge(),
                                        Infolists\Components\TextEntry::make('educationBackground.previous_school_day_boarding')
//                                            ->color('info')
                                            ->label('Day/Boarding')
                                            ->badge(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(4),
                                Section::make('Current School')
                                    ->schema([
                                        Infolists\Components\IconEntry::make('educationBackground.currently_attending')
                                            ->label('Currently Attending School')
                                            ->boolean()
                                            ->color(fn ($state): string => $state ? 'success' : 'danger'),
                                        Infolists\Components\TextEntry::make('educationBackground.current_school_name')
                                            ->color('success')
                                            ->label('School Name'),
                                        Infolists\Components\TextEntry::make('educationBackground.current_school_location')
//                                            ->color('success')
                                            ->label('Location')
                                            ->icon('heroicon-o-map-pin'),
                                        Infolists\Components\TextEntry::make('educationBackground.current_school_type')
//                                            ->color('success')
                                            ->label('School Type')
                                            ->badge(),
                                        Infolists\Components\TextEntry::make('educationBackground.current_school_day_boarding')
//                                            ->color('success')
                                            ->label('Day/Boarding')
                                            ->badge(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(4),
                                Section::make('Education Level')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('educationBackground.education_level')
//                                            ->color('success')
                                            ->label('Education Level'),
                                        Infolists\Components\TextEntry::make('educationBackground.current_education_level_detail')
                                            ->label('Level Detail (ECD/Grade/Form/Vocational/Tertiary)')
//                                            ->color('success')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Family')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Section::make('Parents')
                                    ->schema([
                                        Infolists\Components\RepeatableEntry::make('parents')
                                            ->label('')
                                            ->schema([
                                                Infolists\Components\TextEntry::make('type')
                                                    ->label('Parent Type')
                                                    ->badge()
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('name')
//                                                    ->color('primary')
                                                    ->label('Name'),
                                                Infolists\Components\TextEntry::make('other_names')
//                                                    ->color('primary')
                                                    ->label('Other Names'),
                                                Infolists\Components\TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Alive' => 'success',
                                                        'Deceased' => 'danger',
                                                        'Not known' => 'warning',
                                                        default => 'gray',
                                                    }),
                                                Infolists\Components\TextEntry::make('contact')
                                                    ->icon('heroicon-o-phone')
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('last_known_location')
//                                                    ->color('info')
                                                    ->label('Last Known Location')
                                                    ->icon('heroicon-o-map-pin'),
                                                Infolists\Components\TextEntry::make('occupation_or_education')
//                                                    ->color('info')
                                                    ->label('Occupation/Education/Employment')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columnSpanFull()
                                            ->columns(3),
                                    ])
                                    ->columnSpanFull(),
                                Section::make('Siblings')
                                    ->schema([
                                        Infolists\Components\RepeatableEntry::make('siblings')
                                            ->label('')
                                            ->schema([
                                                Infolists\Components\TextEntry::make('name')
                                                    ->label('Name')
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('age')
//                                                    ->color('info')
                                                    ->label('Age'),
                                                Infolists\Components\IconEntry::make('living_with_child')
                                                    ->label('Living with Child')
                                                    ->boolean()
                                                    ->color(fn ($state): string => $state ? 'success' : 'gray'),
                                                Infolists\Components\IconEntry::make('admitted_elsewhere')
                                                    ->label('Admitted Elsewhere')
                                                    ->boolean()
                                                    ->color(fn ($state): string => $state ? 'warning' : 'gray'),
                                                Infolists\Components\TextEntry::make('contact')
                                                    ->icon('heroicon-o-phone')
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('last_known_location')
//                                                    ->color('info')
                                                    ->label('Last Known Location')
                                                    ->icon('heroicon-o-map-pin'),
                                                Infolists\Components\TextEntry::make('occupation_or_education')
                                                    ->label('Occupation/Education/Employment')
//                                                    ->color('info')
                                                    ->columnSpanFull(),
                                            ])
                                            ->columnSpanFull()
                                            ->columns(3),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull()
                            ->columns(3),
                        Tab::make('Health')
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Section::make('Health Status')
                                    ->schema([
                                        Group::make([
                                            Infolists\Components\IconEntry::make('healthRecord.hospitalized')
                                                ->label('Hospitalized')
                                                ->boolean()
                                                ->color(fn ($state): string => $state ? 'warning' : 'success'),
                                            Infolists\Components\TextEntry::make('healthRecord.illness')
                                                ->label('Illness')
                                                ->badge()
                                                ->color('warning')
                                                ->placeholder('No illness recorded'),
                                        ])
                                            ->columns(2),
                                        Infolists\Components\TextEntry::make('healthRecord.health_notes')
                                            ->label('Health Notes')
//                                            ->color('info')
                                            ->columnSpanFull()
                                            ->markdown()
                                            ->prose()
                                            ->placeholder('No health notes recorded'),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                        Tab::make('Signatures')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                Section::make('Signatures')
                                    ->schema([
                                        Infolists\Components\RepeatableEntry::make('signatures')
                                            ->label('')
                                            ->schema([
                                                Infolists\Components\TextEntry::make('role')
                                                    ->label('Role')
                                                    ->badge()
                                                    ->color('info'),
                                                Infolists\Components\TextEntry::make('name')
//                                                    ->color('primary')
                                                    ->label('Name'),
                                                Infolists\Components\TextEntry::make('signed_date')
                                                    ->label('Signed Date')
                                                    ->date('d/m/Y')
                                                    ->icon('heroicon-o-calendar')
                                                    ->color('info'),
                                                Infolists\Components\ImageEntry::make('signature_file')
                                                    ->label('Signature')
                                                    ->columnSpanFull()
                                                    ->imageHeight('150px')
                                                    ->imageWidth('300px'),
                                            ])
                                            ->columnSpanFull()
                                            ->columns(3),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
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
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'view' => Pages\ViewChild::route('/{record}'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
}

