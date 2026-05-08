<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select; // Ajouté
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Str;
use Filament\Forms\Set;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationLabel = 'Portfolio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Détails du Projet')
                    ->description('Gérez les informations et les visuels de vos réalisations.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom de la réalisation')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        
                        Forms\Components\TextInput::make('slug')
                            ->label('Lien permanent (URL)')
                            ->required()
                            ->unique(Portfolio::class, 'slug', ignoreRecord: true),

                        // Champ Année ajouté ici
                        Forms\Components\Select::make('year')
                            ->label('Année de réalisation')
                            ->options(collect(range(date('Y'), 2010))->mapWithKeys(fn ($y) => [$y => $y]))
                            ->default(date('Y'))
                            ->required(),
 TextInput::make('client')
                            ->label('Nom du client')
                            ->maxLength(255),
                             TextInput::make('partenaire')
                            ->label('Nom du partenaire')
                            ->maxLength(255),
                             TextInput::make('link')
                            ->label('Lien vers le projet (URL)')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('status')
                            ->label('Projet visible')
                            ->default(true)
                            ->inline(false), // Aligné avec le select

                        Forms\Components\RichEditor::make('description')
                            ->label('Description du projet')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('images')
                            ->label('Galerie d\'images')
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->appendFiles()
                            ->directory('portfolios')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom du projet')
                    ->searchable()
                    ->sortable(),

                // Colonne Année ajoutée dans la table
                TextColumn::make('year')
                    ->label('Année')
                    ->sortable(),

                ImageColumn::make('images')
                    ->label('Aperçu')
                    ->circular()
                    ->stacked()
                    ->limit(3),
                      TextColumn::make('client')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                      TextColumn::make('partenaire')
                    ->label('Partenaire')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('status')
                    ->label('Statut'),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc') // Tri par année par défaut
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Visibilité'),
                Tables\Filters\SelectFilter::make('year') // Filtre par année ajouté
                    ->label('Année')
                    ->options(collect(range(date('Y'), 2010))->mapWithKeys(fn ($y) => [$y => $y])),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}