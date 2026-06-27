<?php

namespace App\Filament\Admin\Resources\BranchCities\Pages;

use App\Filament\Admin\Resources\BranchCities\BranchCityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBranchCities extends ListRecords
{
    protected static string $resource = BranchCityResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('新增')];
    }
}
