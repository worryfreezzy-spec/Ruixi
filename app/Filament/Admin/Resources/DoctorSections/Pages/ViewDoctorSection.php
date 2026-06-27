<?php

namespace App\Filament\Admin\Resources\DoctorSections\Pages;

use App\Filament\Admin\Resources\DoctorSections\DoctorSectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDoctorSection extends ViewRecord
{
    protected static string $resource = DoctorSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
