<?php

namespace App\Filament\Admin\Resources\LasikCategories\Pages;

use App\Filament\Admin\Resources\LasikCategories\LasikCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLasikCategory extends EditRecord
{
    protected static string $resource = LasikCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
