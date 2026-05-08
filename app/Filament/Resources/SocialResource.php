<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialResource\Pages;
use App\Models\Social;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;

class SocialResource extends Resource
{
    protected static ?string $model = Social::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';
    
    protected static ?string $navigationLabel = 'Réseaux Sociaux';

    protected static ?string $pluralModelLabel = 'Réseaux Sociaux';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Configuration du lien social')
                    ->description('Ajoutez le nom, l\'icône et l\'URL du réseau social.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom du réseau')
                            ->placeholder('Ex: Facebook, LinkedIn...')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('url')
                            ->label('URL du profil')
                            ->url()
                            ->required()
                            ->prefix('https://')
                            ->placeholder('www.facebook.com/votrepage'),

                         TextInput::make('icon')
                            ->label('Icone du réseau')
                            ->placeholder('bi bi-facebook')
                            ->required()
                            ->maxLength(255),

                        Toggle::make('status')
                            ->label('Activer le lien')
                            ->default(true)
                            ->inline(false),
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

                TextColumn::make('url')
                    ->label('Lien URL')
                    ->copyable()
                    ->limit(40),

                TextColumn::make('icon')
                    ->label('Icône')
                    ->badge()
                    ->color('gray'),

                ToggleColumn::make('status')
                    ->label('Statut'),

                TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Uniquement les actifs'),
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
            'index' => Pages\ListSocials::route('/'),
            'create' => Pages\CreateSocial::route('/create'),
            'edit' => Pages\EditSocial::route('/{record}/edit'),
        ];
    }
}