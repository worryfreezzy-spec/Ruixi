<?php

namespace App\Filament\Admin\Resources\EyeDiseases\Pages;

use App\Filament\Admin\Resources\EyeDiseases\EyeDiseaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEyeDisease extends ViewRecord
{
    protected static string $resource = EyeDiseaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('编辑'),
        ];
    }
}
