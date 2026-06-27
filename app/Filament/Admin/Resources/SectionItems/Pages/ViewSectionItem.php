<?php

namespace App\Filament\Admin\Resources\SectionItems\Pages;

use App\Filament\Admin\Resources\SectionItems\SectionItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSectionItem extends ViewRecord
{
    protected static string $resource = SectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
