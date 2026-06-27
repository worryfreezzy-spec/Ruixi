<?php

namespace App\Filament\Admin\Resources\ContactPages\Pages;

use App\Filament\Admin\Resources\ContactPages\ContactPageResource;
use Filament\Resources\Pages\EditRecord;

class EditContactPage extends EditRecord
{
    protected static string $resource = ContactPageResource::class;
}
