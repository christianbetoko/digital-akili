<?php

namespace App\Filament\Resources\CaracteristiqueResource\Pages;

use App\Filament\Resources\CaracteristiqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaracteristiques extends ListRecords
{
    protected static string $resource = CaracteristiqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
