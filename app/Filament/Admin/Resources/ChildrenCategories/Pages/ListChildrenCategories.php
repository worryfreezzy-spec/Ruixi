<?php

namespace App\Filament\Admin\Resources\ChildrenCategories\Pages;

use App\Filament\Admin\Resources\ChildrenCategories\ChildrenCategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListChildrenCategories extends ListRecords
{
    protected static string $resource = ChildrenCategoryResource::class;
}
