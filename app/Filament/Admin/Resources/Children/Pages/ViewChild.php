<?php

namespace App\Filament\Admin\Resources\Children\Pages;

use App\Filament\Admin\Resources\Children\ChildrenResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewChild extends ViewRecord
{
    protected static string $resource = ChildrenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('编辑'),
        ];
    }
}
