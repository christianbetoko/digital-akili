<?php
namespace App\Filament\Resources;

use App\Filament\Resources\NewslettreSubscribersResource\Pages;
use App\Models\NewslettreSubscribers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewslettreSubscribersResource extends Resource
{
    protected static ?string $model = NewslettreSubscribers::class;

    // Icône dans la barre latérale
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    // Nom affiché dans le menu
    protected static ?string $navigationLabel = 'Abonnés Newsletter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de l\'abonné')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('exemple@domaine.com'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Statut actif')
                            ->default(true)
                            ->color('success'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscription')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Statut d\'activité'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewslettreSubscribers::route('/'),
            'create' => Pages\CreateNewslettreSubscribers::route('/create'),
            'edit' => Pages\EditNewslettreSubscribers::route('/{record}/edit'),
        ];
    }
}