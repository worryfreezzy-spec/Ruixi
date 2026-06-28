<?php

namespace App\Filament\Admin\Resources\ServiceSectionItems;

use App\Filament\Admin\Resources\ServiceSectionItems\Pages\CreateServiceSectionItem;
use App\Filament\Admin\Resources\ServiceSectionItems\Pages\EditServiceSectionItem;
use App\Filament\Admin\Resources\ServiceSectionItems\Pages\ListServiceSectionItems;
use App\Filament\Admin\Resources\ServiceSectionItems\Pages\ViewServiceSectionItem;
use App\Filament\Admin\Resources\ServiceSectionItems\Schemas\ServiceSectionItemForm;
use App\Filament\Admin\Resources\ServiceSectionItems\Schemas\ServiceSectionItemInfolist;
use App\Filament\Admin\Resources\ServiceSectionItems\Tables\ServiceSectionItemsTable;
use App\Models\ServiceSectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceSectionItemResource extends Resource
{
    protected static ?string $model = ServiceSectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;
    protected static ?string $modelLabel = '服务区块项目';

    protected static ?string $pluralModelLabel = '服务区块项目';

    protected static ?string $navigationLabel = '服务区块项目';

    protected static string | \UnitEnum | null $navigationGroup = '服务管理';

    protected static ?int $navigationSort = 100;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereDoesntHave('serviceSection.service.category', fn (Builder $query) => $query->whereIn('slug', ['cataract', 'eye-diseases']));
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceSectionItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceSectionItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSectionItemsTable::configure($table);
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
            'index' => ListServiceSectionItems::route('/'),
            'create' => CreateServiceSectionItem::route('/create'),
            'view' => ViewServiceSectionItem::route('/{record}'),
            'edit' => EditServiceSectionItem::route('/{record}/edit'),
        ];
    }
}

