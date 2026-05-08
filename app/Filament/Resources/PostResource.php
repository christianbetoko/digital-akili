<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Gestion Contenu';
    protected static ?string $label = 'Article';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Colonne de gauche : Contenu principal
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Rédaction de l\'actualité')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre de l\'article')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                
                                Forms\Components\TextInput::make('slug')
                                    ->label('Lien permanent (URL)')
                                    ->required()
                                    ->unique(Post::class, 'slug', ignoreRecord: true),
                                
                                Forms\Components\RichEditor::make('content')
                                    ->label('Corps de l\'article')
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                // Colonne de droite : Paramètres, Image et Mise en avant
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Publication & Visibilité')
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Mettre à la une')
                                    ->helperText('Afficher en priorité sur thepolitico.cd')
                                    ->onColor('success')
                                    ->onIcon('heroicon-m-star'),

                                Forms\Components\Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'draft' => 'Brouillon',
                                        'published' => 'Publié',
                                        'archived' => 'Archivé',
                                    ])->default('draft')->required(),

                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->label('Catégorie')
                                    ->required(),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Date de publication')
                                    ->default(now()),
                                
                                Forms\Components\Hidden::make('user_id')
                                    ->default(auth()->id()),
                            ]),

                        Forms\Components\Section::make('Image de couverture')
                            ->schema([
                                Forms\Components\FileUpload::make('image_cover')
                                    ->label('Image principale')
                                    ->image()
                                      ->directory('posts-covers') // Stocké dans storage/app/public/posts-covers
                                    
                                    ->visibility('public')
                                    ->imageEditor(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_cover')
                    ->label('Image')
                    ->square(),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(40)
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Vedette')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-s-star')
                    ->trueColor('warning'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->badge(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Statut')
                    ->options([
                        'draft' => 'Brouillon',
                        'published' => 'Publié',
                        'archived' => 'Archivé',
                    ]),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Articles à la une'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}