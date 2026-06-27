<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryItems\Pages;

use App\Filament\Admin\Resources\PlasticSurgeryItems\PlasticSurgeryItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlasticSurgeryItems extends ListRecords
{
    protected static string $resource = PlasticSurgeryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('新增'),
        ];
    }
}
