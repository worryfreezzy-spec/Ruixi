<?php

namespace App\Filament\Admin\Resources\EyeDiseases\Pages;

use App\Filament\Admin\Resources\EyeDiseases\EyeDiseaseResource;
use App\Models\ServiceCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateEyeDisease extends CreateRecord
{
    protected static string $resource = EyeDiseaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category_id'] = ServiceCategory::query()->where('slug', 'eye-diseases')->value('id');

        return $data;
    }
}
