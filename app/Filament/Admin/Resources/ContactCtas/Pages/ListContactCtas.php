<?php

namespace App\Filament\Admin\Resources\ContactCtas\Pages;

use App\Filament\Admin\Resources\ContactCtas\ContactCtaResource;
use Filament\Resources\Pages\ListRecords;

class ListContactCtas extends ListRecords
{
    protected static string $resource = ContactCtaResource::class;
}
