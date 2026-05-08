<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    
    protected static ?string $navigationLabel = 'Témoignages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Détails du Témoignage')
                    ->description('Informations sur la personne et son avis.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('role')
                            ->label('Fonction / Entreprise')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: CEO chez Google'),

                        Textarea::make('speech')
                            ->label('Témoignage (Texte)')
                            ->required()
                            ->rows(5)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        FileUpload::make('photo')
                            ->label('Photo de la personne')
                            ->image()
                            ->directory('testimonials')
                            ->avatar() // Rend l'upload circulaire dans le formulaire
                            ->imageEditor(),

                        Select::make('status')
                            ->label('Statut de publication')
                            ->options([
                                1 => 'Actif / Visible',
                                0 => 'Inactif / Masqué',
                            ])
                            ->default(1)
                            ->required()
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Rôle')
                    ->searchable(),

                TextColumn::make('speech')
                    ->label('Message')
                    ->limit(50)
                    ->tooltip(fn (Testimonial $record): string => $record->speech),

                SelectColumn::make('status')
                    ->label('Statut')
                    ->options([
                        1 => 'Actif',
                        0 => 'Inactif',
                    ]),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        1 => 'Actif',
                        0 => 'Inactif',
                    ]),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}