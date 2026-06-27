<?php

namespace App\Filament\Admin\Resources\FooterMenuItems\Pages;

use App\Filament\Admin\Resources\FooterMenuItems\FooterMenuItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFooterMenuItem extends ViewRecord
{
    protected static string $resource = FooterMenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
