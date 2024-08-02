<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StadiumResource\Pages;
use App\Filament\Resources\StadiumResource\RelationManagers;
use App\Models\Stadium;
use DateTime;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nnjeim\World\Models\Country;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class StadiumResource extends Resource
{
    protected static ?string $model = Stadium::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Stadiums';
    protected static ?string $navigationGroup = 'Structures';
    public static function getModelLabel(): string
    {
        return 'Stadiums';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')->tabs([
                    Tab::make('Info')->icon('heroicon-o-identification')->schema([
                        Fieldset::make('Stadium Info')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                ->live()
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug'),
                                TextInput::make('full_name'),
                                TextInput::make('nickname'),
                                TinyEditor::make('history')
                                    ->columnSpanFull(),
                                DatePicker::make('year_built'),
                            ])
                    ]),
                    Tab::make('Field')->icon('heroicon-o-arrows-pointing-in')->schema([
                        Fieldset::make('Turf Info')
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->image(),
                                Forms\Components\TextInput::make('capacity')
                                    ->numeric(),
                                Select::make('surface')
                                    ->options([
                                        'Grass' => 'Grass',
                                        'Turf' => 'Turf',
                                        'Artificial' => 'Artificial',
                                    ]),
                            ])
                    ]),
                    Tab::make('Local')->icon('heroicon-o-globe-americas')->schema([
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->required()
                            ->default('United States')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('state')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        ]),
                ])->columnSpanFull(),//->contained(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('capacity')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('surface')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_built')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('state')
                    ->form([
                        Select::make('state')
                            ->options(
                                Stadium::query()
                                    ->distinct()
                                    ->orderBy('state')
                                    ->pluck('state', 'state')
                                    ->toArray()
                            )
                            ->placeholder('Select a state')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        // Check if the state is set before applying the filter
                        if (!empty($data['state'])) {
                            return $query->where('state', $data['state']);
                        }
                        return $query;
                    }),
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter')
                    ->slideOver(),
            )
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('')
                ->tooltip('Edit'),
                Tables\Actions\DeleteAction::make()
                ->label('')
                ->tooltip('Delete'),
                Tables\Actions\RestoreAction::make()
                ->label(''),
                Tables\Actions\ForceDeleteAction::make()
                ->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListStadia::route('/'),
            'create' => Pages\CreateStadium::route('/create'),
            'edit' => Pages\EditStadium::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
