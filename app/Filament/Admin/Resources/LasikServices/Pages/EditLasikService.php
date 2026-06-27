<?php

namespace App\Filament\Admin\Resources\LasikServices\Pages;

use App\Filament\Admin\Resources\LasikServices\LasikServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLasikService extends EditRecord
{
    protected static string $resource = LasikServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
