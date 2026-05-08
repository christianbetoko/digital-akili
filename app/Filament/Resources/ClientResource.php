<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationLabel = 'Nos Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations Client')
                    ->description('Détails du client et logo.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom de l\'entreprise')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('link')
                            ->label('Lien du site web')
                            ->url()
                            ->placeholder('https://www.client.com')
                            ->maxLength(255),

                        TextInput::make('description')
                            ->label('Brève description')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        FileUpload::make('logo')
                            ->label('Logo du client')
                            ->image()
                            ->directory('clients-logos')
                            ->imageEditor()
                            ,

                        Toggle::make('status')
                            ->label('Afficher sur le site')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),

                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('link')
                    ->label('Site Web')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('primary')
                    ->openUrlInNewTab(),

                ToggleColumn::make('status')
                    ->label('Actif'),

                TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Statut actif'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}