<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DivisionResource\Pages;
use App\Filament\Resources\DivisionResource\RelationManagers;
use App\Models\Division;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class DivisionResource extends Resource
{
    protected static ?string $model = Division::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Organization';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('')->tabs([
                    Tab::make('Info')->icon('heroicon-o-identification')->schema([
                        Fieldset::make('Info')->schema([
                            Forms\Components\TextInput::make('name')
                                ->live()
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            Forms\Components\TextInput::make('slug'),
                            Forms\Components\TextInput::make('simble')
                                ->maxLength(255),
                        ])
                        ]),
                        Tab::make('Colors')->icon('heroicon-o-paint-brush')->schema([
                            Fieldset::make('Colors')->schema([
                                Forms\Components\TextInput::make('hex1')
                                    ->maxLength(6)
                                    ->prefix('#'),
                                Forms\Components\TextInput::make('hex2')
                                    ->maxLength(6)
                                    ->prefix('#'),
                                Forms\Components\TextInput::make('hex3')
                                    ->maxLength(6)
                                    ->prefix('#'),
                                FileUpload::make('logo')
                                    ->image(),
                            ])
                        ]),
                        Tab::make('History')->icon('heroicon-o-book-open')->schema([
                            Fieldset::make('History')->schema([
                                TinyEditor::make('history')
                                    ->columnSpanFull(),
                                Forms\Components\DatePicker::make('creation_date')
                                    ->required(),
                            ])
                            ]),
                        Tab::make('Fillieation')->icon('heroicon-o-rectangle-group')->schema([
                            Fieldset::make('Fillieted at')->schema([
                                Select::make('organization_id')
                                    ->relationship('organization','name'), 
                            ])
                            ]),
                        Tab::make('Adicional Contact')->icon('heroicon-o-phone')->schema([
                            Fieldset::make('Contact')->schema([
                                Forms\Components\TextInput::make('website')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                            ])
                            ]),
                        Tab::make('Local')->icon('heroicon-o-arrows-pointing-in')->schema([
                            Fieldset::make('Localization Info')->schema([
                                Forms\Components\TextInput::make('country')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('state')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('city')
                                    ->required()
                                    ->maxLength(255),
                            ])
                        ])
                ])->columnSpanFull(),                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('organization.simble')
                    ->label('Organizations')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('hex1')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('hex2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),                  
                Tables\Columns\TextColumn::make('hex3')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('simble')
                    ->searchable(),
                Tables\Columns\TextColumn::make('creation_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
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
                                Division::query()
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
                    Filter::make('state')
                    ->form([
                        Select::make('state')
                            ->options(
                                Division::query()
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
            'index' => Pages\ListDivisions::route('/'),
            'create' => Pages\CreateDivision::route('/create'),
            'edit' => Pages\EditDivision::route('/{record}/edit'),
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
