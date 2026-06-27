<?php

namespace App\Filament\Admin\Resources\Children\Pages;

use App\Filament\Admin\Resources\Children\ChildrenResource;
use Filament\Resources\Pages\EditRecord;

class EditChild extends EditRecord
{
    protected static string $resource = ChildrenResource::class;
}
