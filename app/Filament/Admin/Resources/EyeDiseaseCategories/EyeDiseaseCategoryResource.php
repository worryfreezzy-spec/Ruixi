<?php

namespace App\Filament\Admin\Resources\EyeDiseaseCategories;

use App\Filament\Admin\Resources\EyeDiseaseCategories\Pages\EditEyeDiseaseCategory;
use App\Filament\Admin\Resources\EyeDiseaseCategories\Pages\ListEyeDiseaseCategories;
use App\Filament\Admin\Resources\EyeDiseaseCategories\Schemas\EyeDiseaseCategoryForm;
use App\Filament\Admin\Resources\ServiceCategories\Tables\ServiceCategoriesTable;
use App\Models\ServiceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EyeDiseaseCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = '眼睛疾病页面';

    protected static ?string $pluralModelLabel = '眼睛疾病页面管理';

    protected static ?string $navigationLabel = '页面管理';

    protected static string|\UnitEnum|null $navigationGroup = '眼睛疾病';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'eye-diseases');
    }

    public static function form(Schema $schema): Schema
    {
        return EyeDiseaseCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEyeDiseaseCategories::route('/'),
            'edit' => EditEyeDiseaseCategory::route('/{record}/edit'),
        ];
    }
}
