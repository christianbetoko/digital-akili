<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnterpriseResource\Pages;
use App\Models\Enterprise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class EnterpriseResource extends Resource
{
    protected static ?string $model = Enterprise::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    
    protected static ?string $navigationLabel = 'Configuration Entreprise';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Configuration de l\'entreprise')
                    ->tabs([
                        // Onglet 1 : Informations de base
                        Tabs\Tab::make('Identité')
                            ->icon('heroicon-m-identification')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nom de l\'entreprise')
                                    ->maxLength(255),
                                TextInput::make('slogan')
                                    ->label('Slogan')
                                    ->maxLength(255),
                                Textarea::make('about')
                                    ->label('En bref (About)')
                                    ->rows(3),
                                RichEditor::make('description')
                                    ->label('Description complète')
                                    ->columnSpanFull(),
                            ]),

                        // Onglet 2 : Vision & Mission
                        Tabs\Tab::make('Stratégie')
                            ->icon('heroicon-m-rocket-launch')
                            ->schema([
                                TextInput::make('mission')
                                    ->label('Notre Mission')
                                    ->maxLength(255),
                                TextInput::make('vision')
                                    ->label('Notre Vision')
                                    ->maxLength(255),
                            ]),

                        // Onglet 3 : Contact & Localisation
                        Tabs\Tab::make('Contact')
                            ->icon('heroicon-m-phone')
                            ->schema([
                                TextInput::make('address')
                                    ->label('Adresse physique')
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('Téléphone')
                                    ->tel(),
                                TextInput::make('email')
                                    ->label('Email de contact')
                                    ->email(),
                                TextInput::make('website')
                                    ->label('Site Web')
                                    ->url()
                                    ->prefix('https://'),
                            ])->columns(2),

                        // Onglet 4 : Logos
                        Tabs\Tab::make('Logos')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                FileUpload::make('logo_with_bg')
                                    ->label('Logo avec fond')
                                    ->image()
                                    ->directory('enterprise')
                                    ->imageEditor(),
                                FileUpload::make('logo_without_bg')
                                    ->label('Logo transparent (PNG)')
                                    ->image()
                                    ->directory('enterprise')
                                    ->imageEditor(),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_without_bg')
                    ->label('Logo'),
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->copyable(),
                TextColumn::make('phone')
                    ->label('Téléphone'),
                TextColumn::make('updated_at')
                    ->label('Dernière mise à jour')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEnterprises::route('/'),
            'create' => Pages\CreateEnterprise::route('/create'),
            'edit' => Pages\EditEnterprise::route('/{record}/edit'),
        ];
    }
}