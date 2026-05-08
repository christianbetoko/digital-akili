<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Membres';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations Personnelles')
                    ->description('Détails d\'identité et biographie du membre.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('role')
                            ->label('Rôle / Poste')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('bio')
                            ->label('Biographie')
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        FileUpload::make('image')
                            ->label('Photo de profil')
                            ->image()
                            ->directory('members-photos')
                            ->imageEditor()
                            ,

                        Toggle::make('status')
                            ->label('Membre Actif')
                            ->default(true)
                            ->required(),
                    ])->columnSpan(2),

                Section::make('Réseaux Sociaux')
                    ->description('Liens vers les profils externes.')
                    ->schema([
                        TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->prefix('https://'),
                        
                        TextInput::make('twitter')
                            ->label('Twitter / X')
                            ->url()
                            ->prefix('https://'),
                        
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->url()
                            ->prefix('https://'),
                        
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->url()
                            ->prefix('https://'),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Photo')
                    ->circular(),
                
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),

                IconColumn::make('status')
                    ->label('Statut')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Filtrer par statut'),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}