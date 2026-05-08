<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    
    protected static ?string $navigationGroup = 'Gestion Contenu';
    
    protected static ?string $label = 'Commentaire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails du commentaire')
                    ->schema([
                        Forms\Components\TextInput::make('user_name')
                            ->label('Nom du visiteur')
                            ->required()
                            ->disabled(), // On désactive pour ne pas modifier l'identité de l'auteur
                        
                        Forms\Components\TextInput::make('user_email')
                            ->label('Email')
                            ->email()
                            ->disabled(),

                        Forms\Components\Select::make('post_id')
                            ->label('Article concerné')
                            ->relationship('post', 'title')
                            ->disabled()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content')
                            ->label('Contenu du message')
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),

                        Forms\Components\Toggle::make('is_visible')
                            ->label('Approuver ce commentaire')
                            ->helperText('Si coché, le commentaire sera visible sur le site.')
                            ->onColor('success')
                            ->default(false),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_name')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('post.title')
                    ->label('Article')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->post->title)
                    ->searchable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Commentaire')
                    ->limit(50)
                    ->wrap(),

                // Permet de valider directement depuis la liste sans ouvrir l'article
                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Les plus récents en premier
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Statut d\'approbation')
                    ->placeholder('Tous les commentaires')
                    ->trueLabel('Commentaires visibles')
                    ->falseLabel('Commentaires en attente'),
                
                Tables\Filters\SelectFilter::make('post')
                    ->label('Filtrer par article')
                    ->relationship('post', 'title')
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    // Affiche un badge avec le nombre de commentaires en attente dans le menu
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_visible', false)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}