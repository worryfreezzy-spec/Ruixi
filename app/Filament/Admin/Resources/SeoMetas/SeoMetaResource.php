<?php

namespace App\Filament\Admin\Resources\SeoMetas;

use App\Filament\Admin\Resources\SeoMetas\Pages\CreateSeoMeta;
use App\Filament\Admin\Resources\SeoMetas\Pages\EditSeoMeta;
use App\Filament\Admin\Resources\SeoMetas\Pages\ListSeoMetas;
use App\Filament\Admin\Resources\SeoMetas\Pages\ViewSeoMeta;
use App\Filament\Admin\Resources\SeoMetas\Schemas\SeoMetaForm;
use App\Filament\Admin\Resources\SeoMetas\Schemas\SeoMetaInfolist;
use App\Filament\Admin\Resources\SeoMetas\Tables\SeoMetasTable;
use App\Models\SeoMeta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoMetaResource extends Resource
{
    protected static ?string $model = SeoMeta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected static ?string $modelLabel = 'SEO管理';

    protected static ?string $pluralModelLabel = 'SEO管理';

    protected static ?string $navigationLabel = 'SEO管理';

    protected static string|\UnitEnum|null $navigationGroup = '网站设置';

    protected static ?int $navigationSort = 50;

    public static function getNavigationUrl(): string
    {
        $seoMeta = SeoMeta::query()->oldest('id')->first();

        if (! $seoMeta) {
            return static::getUrl('create');
        }

        return static::getUrl('edit', ['record' => $seoMeta]);
    }

    public static function form(Schema $schema): Schema
    {
        return SeoMetaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SeoMetaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoMetasTable::configure($table);
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
            'index' => ListSeoMetas::route('/'),
            'create' => CreateSeoMeta::route('/create'),
            'view' => ViewSeoMeta::route('/{record}'),
            'edit' => EditSeoMeta::route('/{record}/edit'),
        ];
    }
}
