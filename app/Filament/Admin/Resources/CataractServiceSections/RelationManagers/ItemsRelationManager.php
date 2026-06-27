<?php

namespace App\Filament\Admin\Resources\CataractServiceSections\RelationManagers;

use App\Filament\Admin\Resources\ServiceSectionItems\Schemas\ServiceSectionItemForm;
use App\Filament\Admin\Resources\ServiceSectionItems\Tables\ServiceSectionItemsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = '文章区块项目';

    public function form(Schema $schema): Schema
    {
        return ServiceSectionItemForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return ServiceSectionItemsTable::configure($table);
    }
}
