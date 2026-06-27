<?php

namespace App\Filament\Admin\Resources\FooterMenuItems\Pages;

use App\Filament\Admin\Resources\FooterMenuItems\FooterMenuItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterMenuItem extends EditRecord
{
    protected static string $resource = FooterMenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
