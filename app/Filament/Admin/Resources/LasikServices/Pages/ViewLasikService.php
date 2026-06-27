<?php

namespace App\Filament\Admin\Resources\LasikServices\Pages;

use App\Filament\Admin\Resources\LasikServices\LasikServiceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLasikService extends ViewRecord
{
    protected static string $resource = LasikServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('编辑'),
        ];
    }
}
