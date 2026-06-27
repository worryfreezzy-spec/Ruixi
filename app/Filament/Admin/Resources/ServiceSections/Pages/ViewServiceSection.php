<?php

namespace App\Filament\Admin\Resources\ServiceSections\Pages;

use App\Filament\Admin\Resources\ServiceSections\ServiceSectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceSection extends ViewRecord
{
    protected static string $resource = ServiceSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
