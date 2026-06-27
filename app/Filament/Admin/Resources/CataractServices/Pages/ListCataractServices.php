<?php

namespace App\Filament\Admin\Resources\CataractServices\Pages;

use App\Filament\Admin\Resources\CataractServices\CataractServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCataractServices extends ListRecords
{
    protected static string $resource = CataractServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('新增'),
        ];
    }
}
