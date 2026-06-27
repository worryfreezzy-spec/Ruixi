<?php

namespace App\Filament\Admin\Resources\Children\Pages;

use App\Filament\Admin\Resources\Children\ChildrenResource;
use App\Models\ServiceCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateChild extends CreateRecord
{
    protected static string $resource = ChildrenResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['category_id'] = ServiceCategory::query()->where('slug', 'kids')->value('id');

        return $data;
    }
}
