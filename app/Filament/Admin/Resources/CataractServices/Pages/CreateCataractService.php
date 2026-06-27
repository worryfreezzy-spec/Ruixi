<?php

namespace App\Filament\Admin\Resources\CataractServices\Pages;

use App\Filament\Admin\Resources\CataractServices\CataractServiceResource;
use App\Models\ServiceCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateCataractService extends CreateRecord
{
    protected static string $resource = CataractServiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category_id'] = ServiceCategory::query()->where('slug', 'cataract')->value('id');

        return $data;
    }
}
