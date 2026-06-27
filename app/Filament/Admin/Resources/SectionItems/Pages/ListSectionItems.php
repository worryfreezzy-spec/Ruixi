<?php

namespace App\Filament\Admin\Resources\SectionItems\Pages;

use App\Filament\Admin\Resources\SectionItems\SectionItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSectionItems extends ListRecords
{
    protected static string $resource = SectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
