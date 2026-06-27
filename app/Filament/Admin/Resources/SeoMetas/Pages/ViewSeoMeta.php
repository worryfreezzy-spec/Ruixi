<?php

namespace App\Filament\Admin\Resources\SeoMetas\Pages;

use App\Filament\Admin\Resources\SeoMetas\SeoMetaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSeoMeta extends ViewRecord
{
    protected static string $resource = SeoMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
