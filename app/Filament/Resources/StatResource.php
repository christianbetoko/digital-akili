<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static ?string $navigationLabel = 'Statistiques';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Configuration de la Statistique')
                    ->description('Définissez le compteur et l\'icône associée.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->placeholder('Ex: Clients satisfaits')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('number')
                            ->label('Nombre / Valeur')
                            ->numeric()
                            ->required()
                            ->placeholder('Ex: 1500'),

                        TextInput::make('icon')
                            ->label('Icône (Code)')
                            ->placeholder('Ex: fa-solid fa-users')
                            ->maxLength(255),

                        TextInput::make('link')
                            ->label('Lien (URL)')
                            ->url()
                            ->placeholder('https://...')
                            ->maxLength(255),

                        Toggle::make('status')
                            ->label('Afficher sur le site')
                            ->default(true)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('number')
                    ->label('Valeur')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('icon')
                    ->label('Icône')
                    ->fontFamily('mono'),

                ToggleColumn::make('status')
                    ->label('Statut'),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Visibilité'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}