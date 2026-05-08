<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaracteristiqueResource\Pages;
use App\Models\Caracteristique;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class CaracteristiqueResource extends Resource
{
    protected static ?string $model = Caracteristique::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    
    protected static ?string $navigationLabel = 'Caractéristiques';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Détails de la Caractéristique')
                    ->description('Gérez les points forts ou spécificités techniques.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: Rapidité, Sécurité...'),

                        TextInput::make('icon')
                            ->label('Icône')
                            ->maxLength(255)
                            ->placeholder('Ex: fa-solid fa-check ou heroicon-o-star')
                            ->helperText('Saisissez le nom de la classe d\'icône.'),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Toggle::make('status')
                            ->label('Actif')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('icon')
                    ->label('Code Icône')
                    ->fontFamily('mono')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),

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
            'index' => Pages\ListCaracteristiques::route('/'),
            'create' => Pages\CreateCaracteristique::route('/create'),
            'edit' => Pages\EditCaracteristique::route('/{record}/edit'),
        ];
    }
}