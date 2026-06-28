<?php

namespace App\Filament\Admin\Resources\FooterMenuItems;

use App\Filament\Admin\Resources\FooterMenuItems\Pages\CreateFooterMenuItem;
use App\Filament\Admin\Resources\FooterMenuItems\Pages\EditFooterMenuItem;
use App\Filament\Admin\Resources\FooterMenuItems\Pages\ListFooterMenuItems;
use App\Filament\Admin\Resources\FooterMenuItems\Pages\ViewFooterMenuItem;
use App\Filament\Admin\Resources\MenuItems\Schemas\MenuItemForm;
use App\Filament\Admin\Resources\MenuItems\Schemas\MenuItemInfolist;
use App\Filament\Admin\Resources\MenuItems\Tables\MenuItemsTable;
use App\Models\MenuItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FooterMenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3BottomLeft;

    protected static ?string $modelLabel = '底部导航';

    protected static ?string $pluralModelLabel = '底部导航';

    protected static ?string $navigationLabel = '底部导航';

    protected static string|\UnitEnum|null $navigationGroup = '网站设置';

    protected static ?int $navigationSort = 40;

    protected static ?string $slug = 'footer-menu-items';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select('menu_items.*')
            ->leftJoin('menu_items as parent_items', 'menu_items.parent_id', '=', 'parent_items.id')
            ->whereHas('menu', fn (Builder $query) => $query->where('location', 'footer'))
            ->orderByRaw('COALESCE(parent_items.sort_order, menu_items.sort_order) asc')
            ->orderByRaw('CASE WHEN menu_items.parent_id IS NULL THEN 0 ELSE 1 END asc')
            ->orderBy('menu_items.sort_order')
            ->orderBy('menu_items.id');
    }

    public static function form(Schema $schema): Schema
    {
        return MenuItemForm::configure($schema, 'footer');
    }

    public static function infolist(Schema $schema): Schema
    {
        return MenuItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemsTable::configure($table);
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
            'index' => ListFooterMenuItems::route('/'),
            'create' => CreateFooterMenuItem::route('/create'),
            'view' => ViewFooterMenuItem::route('/{record}'),
            'edit' => EditFooterMenuItem::route('/{record}/edit'),
        ];
    }
}
