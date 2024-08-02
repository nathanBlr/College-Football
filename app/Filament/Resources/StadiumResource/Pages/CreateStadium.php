<?php

namespace App\Filament\Resources\StadiumResource\Pages;

use App\Filament\Resources\StadiumResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateStadium extends CreateRecord
{
    protected static string $resource = StadiumResource::class;

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
