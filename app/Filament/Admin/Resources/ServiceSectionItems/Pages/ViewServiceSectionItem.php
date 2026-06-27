<?php

namespace App\Filament\Admin\Resources\ServiceSectionItems\Pages;

use App\Filament\Admin\Resources\ServiceSectionItems\ServiceSectionItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceSectionItem extends ViewRecord
{
    protected static string $resource = ServiceSectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
