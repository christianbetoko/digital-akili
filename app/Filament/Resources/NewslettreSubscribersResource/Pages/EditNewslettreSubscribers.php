<?php

namespace App\Filament\Resources\NewslettreSubscribersResource\Pages;

use App\Filament\Resources\NewslettreSubscribersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewslettreSubscribers extends EditRecord
{
    protected static string $resource = NewslettreSubscribersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
