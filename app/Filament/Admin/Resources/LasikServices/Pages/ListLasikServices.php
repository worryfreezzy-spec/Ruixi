<?php

namespace App\Filament\Admin\Resources\LasikServices\Pages;

use App\Filament\Admin\Resources\LasikServices\LasikServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLasikServices extends ListRecords
{
    protected static string $resource = LasikServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('新增'),
        ];
    }
}
