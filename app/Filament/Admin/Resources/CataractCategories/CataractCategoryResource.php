<?php

namespace App\Filament\Admin\Resources\CataractCategories;

use App\Filament\Admin\Resources\CataractCategories\Pages\EditCataractCategory;
use App\Filament\Admin\Resources\CataractCategories\Pages\ListCataractCategories;
use App\Filament\Admin\Resources\ServiceCategories\Schemas\ServiceCategoryForm;
use App\Filament\Admin\Resources\ServiceCategories\Tables\ServiceCategoriesTable;
use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CataractCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $modelLabel = '白内障治疗栏目';

    protected static ?string $pluralModelLabel = '白内障治疗栏目';

    protected static ?string $navigationLabel = '栏目设置';

    protected static string|\UnitEnum|null $navigationGroup = '白内障治疗';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'cataract');
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCataractCategories::route('/'),
            'edit' => EditCataractCategory::route('/{record}/edit'),
        ];
    }
}
