<?php

namespace App\Filament\Admin\Resources\MenuItems;

use App\Filament\Admin\Resources\MenuItems\Pages\CreateMenuItem;
use App\Filament\Admin\Resources\MenuItems\Pages\EditMenuItem;
use App\Filament\Admin\Resources\MenuItems\Pages\ListMenuItems;
use App\Filament\Admin\Resources\MenuItems\Pages\ViewMenuItem;
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

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $modelLabel = '顶部导航';

    protected static ?string $pluralModelLabel = '顶部导航';

    protected static ?string $navigationLabel = '顶部导航';

    protected static string|\UnitEnum|null $navigationGroup = '网站设置';

    protected static ?int $navigationSort = 30;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select('menu_items.*')
            ->leftJoin('menu_items as parent_items', 'menu_items.parent_id', '=', 'parent_items.id')
            ->whereHas('menu', fn (Builder $query) => $query->where('location', 'header'))
            ->orderByRaw('COALESCE(parent_items.sort_order, menu_items.sort_order) asc')
            ->orderByRaw('CASE WHEN menu_items.parent_id IS NULL THEN 0 ELSE 1 END asc')
            ->orderBy('menu_items.sort_order')
            ->orderBy('menu_items.id');
    }

    public static function form(Schema $schema): Schema
    {
        return MenuItemForm::configure($schema, 'header');
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
            'index' => ListMenuItems::route('/'),
            'create' => CreateMenuItem::route('/create'),
            'view' => ViewMenuItem::route('/{record}'),
            'edit' => EditMenuItem::route('/{record}/edit'),
        ];
    }
}
