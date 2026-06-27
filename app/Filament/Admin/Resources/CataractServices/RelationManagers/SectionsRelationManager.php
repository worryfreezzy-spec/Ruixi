<?php

namespace App\Filament\Admin\Resources\CataractServices\RelationManagers;

use App\Filament\Admin\Resources\ServiceSections\Schemas\ServiceSectionForm;
use App\Filament\Admin\Resources\ServiceSections\Tables\ServiceSectionsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = '文章内容区块';

    public function form(Schema $schema): Schema
    {
        return ServiceSectionForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return ServiceSectionsTable::configure($table);
    }
}
