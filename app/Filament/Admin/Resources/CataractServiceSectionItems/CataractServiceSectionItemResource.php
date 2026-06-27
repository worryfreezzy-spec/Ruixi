<?php

namespace App\Filament\Admin\Resources\CataractServiceSectionItems;

use App\Filament\Admin\Resources\CataractServiceSectionItems\Pages\CreateCataractServiceSectionItem;
use App\Filament\Admin\Resources\CataractServiceSectionItems\Pages\EditCataractServiceSectionItem;
use App\Filament\Admin\Resources\CataractServiceSectionItems\Pages\ListCataractServiceSectionItems;
use App\Filament\Admin\Resources\ServiceSectionItems\Schemas\ServiceSectionItemForm;
use App\Filament\Admin\Resources\ServiceSectionItems\Tables\ServiceSectionItemsTable;
use App\Models\ServiceSectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CataractServiceSectionItemResource extends Resource
{
    protected static ?string $model = ServiceSectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $modelLabel = '白内障区块项目';

    protected static ?string $pluralModelLabel = '白内障区块项目';

    protected static ?string $navigationLabel = '文章区块项目';

    protected static string|\UnitEnum|null $navigationGroup = '白内障治疗';

    protected static ?int $navigationSort = 40;

    protected static bool $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('serviceSection.service.category', fn (Builder $query) => $query->where('slug', 'cataract'));
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceSectionItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSectionItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCataractServiceSectionItems::route('/'),
            'create' => CreateCataractServiceSectionItem::route('/create'),
            'edit' => EditCataractServiceSectionItem::route('/{record}/edit'),
        ];
    }
}
