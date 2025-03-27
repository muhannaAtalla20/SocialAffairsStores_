<?php

namespace App\Filament\Resources\AidDistributionResource\Pages;

use App\Filament\Resources\AidDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAidDistributions extends ListRecords
{
    protected static string $resource = AidDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
