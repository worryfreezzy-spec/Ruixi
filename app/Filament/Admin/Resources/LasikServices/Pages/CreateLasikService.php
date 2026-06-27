<?php

namespace App\Filament\Admin\Resources\LasikServices\Pages;

use App\Filament\Admin\Resources\LasikServices\LasikServiceResource;
use App\Models\ServiceCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateLasikService extends CreateRecord
{
    protected static string $resource = LasikServiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category_id'] = ServiceCategory::query()->where('slug', 'laser-vision-correction')->value('id');

        return $data;
    }
}
