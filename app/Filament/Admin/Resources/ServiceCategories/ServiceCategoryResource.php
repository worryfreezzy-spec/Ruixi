<?php

namespace App\Filament\Admin\Resources\ServiceCategories;

use App\Filament\Admin\Resources\ServiceCategories\Pages\CreateServiceCategory;
use App\Filament\Admin\Resources\ServiceCategories\Pages\EditServiceCategory;
use App\Filament\Admin\Resources\ServiceCategories\Pages\ListServiceCategories;
use App\Filament\Admin\Resources\ServiceCategories\Pages\ViewServiceCategory;
use App\Filament\Admin\Resources\ServiceCategories\Schemas\ServiceCategoryForm;
use App\Filament\Admin\Resources\ServiceCategories\Schemas\ServiceCategoryInfolist;
use App\Filament\Admin\Resources\ServiceCategories\Tables\ServiceCategoriesTable;
use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $modelLabel = '服务分类';

    protected static ?string $pluralModelLabel = '服务分类';

    protected static ?string $navigationLabel = '服务分类';

    protected static string | \UnitEnum | null $navigationGroup = '服务管理';

    protected static ?int $navigationSort = 70;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNotIn('slug', ['cataract', 'eye-diseases']);
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceCategories::route('/'),
            'create' => CreateServiceCategory::route('/create'),
            'view' => ViewServiceCategory::route('/{record}'),
            'edit' => EditServiceCategory::route('/{record}/edit'),
        ];
    }
}

