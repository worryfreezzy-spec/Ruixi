<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Pages;

use App\Filament\Admin\Resources\ContactFormFields\ContactFormFieldResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactFormFields extends ListRecords
{
    protected static string $resource = ContactFormFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
