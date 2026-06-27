<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Pages;

use App\Filament\Admin\Resources\ContactFormFields\ContactFormFieldResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactFormField extends ViewRecord
{
    protected static string $resource = ContactFormFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
