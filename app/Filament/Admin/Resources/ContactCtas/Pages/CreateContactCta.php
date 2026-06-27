<?php

namespace App\Filament\Admin\Resources\ContactCtas\Pages;

use App\Filament\Admin\Resources\ContactCtas\ContactCtaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactCta extends CreateRecord
{
    protected static string $resource = ContactCtaResource::class;
}
