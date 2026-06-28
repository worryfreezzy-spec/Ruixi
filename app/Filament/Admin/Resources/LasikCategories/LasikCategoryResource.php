<?php

namespace App\Filament\Admin\Resources\LasikCategories;

use App\Filament\Admin\Resources\LasikCategories\Pages\EditLasikCategory;
use App\Filament\Admin\Resources\LasikCategories\Pages\ListLasikCategories;
use App\Filament\Admin\Resources\LasikCategories\Schemas\LasikCategoryForm;
use App\Filament\Admin\Resources\ServiceCategories\Tables\ServiceCategoriesTable;
use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LasikCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $modelLabel = '栏目设置';

    protected static ?string $pluralModelLabel = '栏目设置';

    protected static ?string $navigationLabel = '栏目设置';

    protected static string|\UnitEnum|null $navigationGroup = '激光矫视';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'laser-vision-correction');
    }

    public static function form(Schema $schema): Schema
    {
        return LasikCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLasikCategories::route('/'),
            'edit' => EditLasikCategory::route('/{record}/edit'),
        ];
    }
}
