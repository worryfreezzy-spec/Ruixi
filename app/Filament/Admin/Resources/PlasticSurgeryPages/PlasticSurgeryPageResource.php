<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryPages;

use App\Filament\Admin\Resources\PlasticSurgeryPages\Pages\EditPlasticSurgeryPage;
use App\Filament\Admin\Resources\PlasticSurgeryPages\Pages\ListPlasticSurgeryPages;
use App\Filament\Admin\Resources\PlasticSurgeryPages\Schemas\PlasticSurgeryPageForm;
use App\Filament\Admin\Resources\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PlasticSurgeryPageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = '页面内容';

    protected static ?string $pluralModelLabel = '页面内容';

    protected static ?string $navigationLabel = '页面内容';

    protected static ?string $slug = 'plastic-surgery-page';

    protected static string|\UnitEnum|null $navigationGroup = '整形外科';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'plastic-surgery');
    }

    public static function form(Schema $schema): Schema
    {
        return PlasticSurgeryPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlasticSurgeryPages::route('/'),
            'edit' => EditPlasticSurgeryPage::route('/{record}/edit'),
        ];
    }
}
