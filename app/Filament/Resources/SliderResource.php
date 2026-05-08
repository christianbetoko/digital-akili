<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
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

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Sliders / Carrousel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Détails du Slider')
                    ->description('Configurez l\'image et les informations d\'affichage du slide.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom du slide')
                            ->maxLength(255),

                        FileUpload::make('image')
                            ->label('Image du slide')
                            ->image()
                            ->directory('sliders') // Stocké dans storage/app/public/sliders
                            ->imageEditor()
                            ->required(),

                        TextInput::make('link')
                            ->label('Lien de redirection (URL)')
                            ->url()
                            ->placeholder('https://exemple.com')
                            ->maxLength(255),

                        TextInput::make('description')
                            ->label('Courte description')
                            ->maxLength(255),

                        Toggle::make('status')
                            ->label('Visible sur le site')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Aperçu')
                    ->size(100),

                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('link')
                    ->label('Lien')
                    ->limit(30)
                    ->copyable(),

                ToggleColumn::make('status')
                    ->label('Statut'),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}