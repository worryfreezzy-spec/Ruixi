<?php

namespace App\Filament\Admin\Resources\DoctorSections\Pages;

use App\Filament\Admin\Resources\DoctorSections\DoctorSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDoctorSection extends EditRecord
{
    protected static string $resource = DoctorSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
