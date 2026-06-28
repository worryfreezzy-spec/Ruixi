<?php

namespace App\Filament\Admin\Resources\ChildrenCategories;

use App\Filament\Admin\Resources\ChildrenCategories\Pages\EditChildrenCategory;
use App\Filament\Admin\Resources\ChildrenCategories\Pages\ListChildrenCategories;
use App\Filament\Admin\Resources\ChildrenCategories\Schemas\ChildrenCategoryForm;
use App\Filament\Admin\Resources\ServiceCategories\Tables\ServiceCategoriesTable;
use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChildrenCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $modelLabel = '页面管理';

    protected static ?string $pluralModelLabel = '页面管理';

    protected static ?string $navigationLabel = '页面管理';

    protected static string|\UnitEnum|null $navigationGroup = '儿童';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'kids');
    }

    public static function form(Schema $schema): Schema
    {
        return ChildrenCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChildrenCategories::route('/'),
            'edit' => EditChildrenCategory::route('/{record}/edit'),
        ];
    }
}
