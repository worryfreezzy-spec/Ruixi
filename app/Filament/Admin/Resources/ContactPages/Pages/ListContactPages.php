<?php

namespace App\Filament\Admin\Resources\ContactPages\Pages;

use App\Filament\Admin\Resources\ContactPages\ContactPageResource;
use Filament\Resources\Pages\ListRecords;

class ListContactPages extends ListRecords
{
    protected static string $resource = ContactPageResource::class;
}
