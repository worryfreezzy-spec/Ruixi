<?php

namespace App\Filament\Admin\Resources\SectionItems\Pages;

use App\Filament\Admin\Resources\SectionItems\SectionItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSectionItem extends EditRecord
{
    protected static string $resource = SectionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
