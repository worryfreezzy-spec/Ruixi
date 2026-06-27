<?php

namespace App\Filament\Admin\Resources\Awards\Pages;

use App\Filament\Admin\Resources\Awards\AwardResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAward extends ViewRecord
{
    protected static string $resource = AwardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
