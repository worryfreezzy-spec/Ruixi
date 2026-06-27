<?php

namespace App\Filament\Admin\Resources\ServiceSectionItems\Pages;

use App\Filament\Admin\Resources\ServiceSectionItems\ServiceSectionItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceSectionItems extends ListRecords
{
    protected static string $resource = ServiceSectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
