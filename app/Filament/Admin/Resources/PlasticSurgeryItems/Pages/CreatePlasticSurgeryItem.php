<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryItems\Pages;

use App\Filament\Admin\Resources\PlasticSurgeryItems\PlasticSurgeryItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePlasticSurgeryItem extends CreateRecord
{
    protected static string $resource = PlasticSurgeryItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['section_id'] = PlasticSurgeryItemResource::getPlasticSectionId();

        return $data;
    }
}
