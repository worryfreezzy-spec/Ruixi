<?php

namespace App\Filament\Admin\Resources\ContactForms\Pages;

use App\Filament\Admin\Resources\ContactForms\ContactFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactForms extends ListRecords
{
    protected static string $resource = ContactFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
