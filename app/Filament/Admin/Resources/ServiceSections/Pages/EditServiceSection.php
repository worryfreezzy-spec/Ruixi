<?php

namespace App\Filament\Admin\Resources\ServiceSections\Pages;

use App\Filament\Admin\Resources\ServiceSections\ServiceSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceSection extends EditRecord
{
    protected static string $resource = ServiceSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
