<?php

namespace App\Filament\Admin\Resources\ServiceSectionItems\Pages;

use App\Filament\Admin\Resources\ServiceSectionItems\ServiceSectionItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceSectionItem extends EditRecord
{
    protected static string $resource = ServiceSectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
