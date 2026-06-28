<?php

namespace App\Filament\Admin\Resources\SectionItems;

use App\Filament\Admin\Resources\SectionItems\Pages\CreateSectionItem;
use App\Filament\Admin\Resources\SectionItems\Pages\EditSectionItem;
use App\Filament\Admin\Resources\SectionItems\Pages\ListSectionItems;
use App\Filament\Admin\Resources\SectionItems\Schemas\SectionItemForm;
use App\Filament\Admin\Resources\SectionItems\Schemas\SectionItemInfolist;
use App\Filament\Admin\Resources\SectionItems\Tables\SectionItemsTable;
use App\Models\SectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SectionItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static ?string $modelLabel = '为什么选择我们';

    protected static ?string $pluralModelLabel = '为什么选择我们';

    protected static ?string $navigationLabel = '为什么选择我们';

    protected static string|\UnitEnum|null $navigationGroup = '首页内容';

    protected static ?int $navigationSort = 40;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('section', fn (Builder $query) => $query->where('type', 'feature_grid'));
    }

    public static function form(Schema $schema): Schema
    {
        return SectionItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SectionItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SectionItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSectionItems::route('/'),
            'create' => CreateSectionItem::route('/create'),
            'edit' => EditSectionItem::route('/{record}/edit'),
        ];
    }
}
