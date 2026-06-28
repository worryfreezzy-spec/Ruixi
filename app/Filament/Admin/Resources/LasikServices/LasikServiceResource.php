<?php

namespace App\Filament\Admin\Resources\LasikServices;

use App\Filament\Admin\Resources\LasikServices\Pages\CreateLasikService;
use App\Filament\Admin\Resources\LasikServices\Pages\EditLasikService;
use App\Filament\Admin\Resources\LasikServices\Pages\ListLasikServices;
use App\Filament\Admin\Resources\LasikServices\Pages\ViewLasikService;
use App\Filament\Admin\Resources\LasikServices\Schemas\LasikServiceForm;
use App\Filament\Admin\Resources\LasikServices\Schemas\LasikServiceInfolist;
use App\Filament\Admin\Resources\LasikServices\Tables\LasikServicesTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LasikServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static ?string $modelLabel = '矫视文章';

    protected static ?string $pluralModelLabel = '矫视列表';

    protected static ?string $navigationLabel = '矫视列表';

    protected static string|\UnitEnum|null $navigationGroup = '激光矫视';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('category', fn (Builder $query) => $query->where('slug', 'laser-vision-correction'));
    }

    public static function form(Schema $schema): Schema
    {
        return LasikServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LasikServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LasikServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLasikServices::route('/'),
            'create' => CreateLasikService::route('/create'),
            'view' => ViewLasikService::route('/{record}'),
            'edit' => EditLasikService::route('/{record}/edit'),
        ];
    }
}
