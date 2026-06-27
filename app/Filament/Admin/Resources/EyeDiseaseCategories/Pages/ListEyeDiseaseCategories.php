<?php

namespace App\Filament\Admin\Resources\EyeDiseaseCategories\Pages;

use App\Filament\Admin\Resources\EyeDiseaseCategories\EyeDiseaseCategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListEyeDiseaseCategories extends ListRecords
{
    protected static string $resource = EyeDiseaseCategoryResource::class;
}
