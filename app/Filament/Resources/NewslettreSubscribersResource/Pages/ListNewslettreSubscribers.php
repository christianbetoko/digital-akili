<?php

namespace App\Filament\Resources\NewslettreSubscribersResource\Pages;

use App\Filament\Resources\NewslettreSubscribersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewslettreSubscribers extends ListRecords
{
    protected static string $resource = NewslettreSubscribersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
