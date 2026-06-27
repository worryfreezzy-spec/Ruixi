<?php

namespace App\Filament\Admin\Resources\DoctorSections\Pages;

use App\Filament\Admin\Resources\DoctorSections\DoctorSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDoctorSections extends ListRecords
{
    protected static string $resource = DoctorSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
