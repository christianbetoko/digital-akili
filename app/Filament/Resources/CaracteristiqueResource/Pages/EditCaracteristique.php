<?php

namespace App\Filament\Resources\CaracteristiqueResource\Pages;

use App\Filament\Resources\CaracteristiqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaracteristique extends EditRecord
{
    protected static string $resource = CaracteristiqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
