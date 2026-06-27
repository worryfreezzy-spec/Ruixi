<?php

namespace App\Filament\Admin\Resources\CataractServices;

use App\Filament\Admin\Resources\CataractServices\Pages\CreateCataractService;
use App\Filament\Admin\Resources\CataractServices\Pages\EditCataractService;
use App\Filament\Admin\Resources\CataractServices\Pages\ListCataractServices;
use App\Filament\Admin\Resources\CataractServices\Schemas\CataractServiceForm;
use App\Filament\Admin\Resources\Services\Tables\ServicesTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CataractServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $modelLabel = '白内障服务文章';

    protected static ?string $pluralModelLabel = '白内障服务文章';

    protected static ?string $navigationLabel = '下级服务文章';

    protected static string|\UnitEnum|null $navigationGroup = '白内障治疗';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('category', fn (Builder $query) => $query->where('slug', 'cataract'));
    }

    public static function form(Schema $schema): Schema
    {
        return CataractServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCataractServices::route('/'),
            'create' => CreateCataractService::route('/create'),
            'edit' => EditCataractService::route('/{record}/edit'),
        ];
    }
}
