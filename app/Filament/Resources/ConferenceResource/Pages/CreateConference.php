<?php

namespace App\Filament\Resources\ConferenceResource\Pages;

use App\Filament\Resources\ConferenceResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateConference extends CreateRecord
{
    protected static string $resource = ConferenceResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('return')
                ->label('')
                ->icon('heroicon-o-arrow-uturn-left')
                ->url($this->getRedirectUrl()),
        ];
    }
}
