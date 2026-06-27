<?php

namespace App\Filament\Admin\Resources\ContactForms\Pages;

use App\Filament\Admin\Resources\ContactForms\ContactFormResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactForm extends CreateRecord
{
    protected static string $resource = ContactFormResource::class;
}
