<?php

namespace App\Filament\Admin\Resources\LasikCategories\Pages;

use App\Filament\Admin\Resources\LasikCategories\LasikCategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListLasikCategories extends ListRecords
{
    protected static string $resource = LasikCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
