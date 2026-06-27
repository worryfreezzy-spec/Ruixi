<?php

namespace App\Filament\Admin\Resources\EyeDiseases\Pages;

use App\Filament\Admin\Resources\EyeDiseases\EyeDiseaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEyeDiseases extends ListRecords
{
    protected static string $resource = EyeDiseaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('新增'),
        ];
    }
}
