<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Pages;

use App\Filament\Admin\Resources\ContactFormFields\ContactFormFieldResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditContactFormField extends EditRecord
{
    protected static string $resource = ContactFormFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
