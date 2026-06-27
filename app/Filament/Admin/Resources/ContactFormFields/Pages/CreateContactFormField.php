<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Pages;

use App\Filament\Admin\Resources\ContactFormFields\ContactFormFieldResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactFormField extends CreateRecord
{
    protected static string $resource = ContactFormFieldResource::class;
}
