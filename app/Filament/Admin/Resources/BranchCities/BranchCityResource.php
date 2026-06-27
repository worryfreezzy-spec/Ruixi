<?php

namespace App\Filament\Admin\Resources\BranchCities;

use App\Filament\Admin\Resources\BranchCities\Pages\CreateBranchCity;
use App\Filament\Admin\Resources\BranchCities\Pages\EditBranchCity;
use App\Filament\Admin\Resources\BranchCities\Pages\ListBranchCities;
use App\Filament\Admin\Resources\BranchCities\Schemas\BranchCityForm;
use App\Filament\Admin\Resources\BranchCities\Tables\BranchCitiesTable;
use App\Models\BranchCity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BranchCityResource extends Resource
{
    protected static ?string $model = BranchCity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $modelLabel = '分行城市';

    protected static ?string $pluralModelLabel = '分行城市管理';

    protected static ?string $navigationLabel = '分行城市管理';

    protected static ?string $slug = 'branch-cities';

    protected static string|\UnitEnum|null $navigationGroup = '联系我们管理';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return BranchCityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BranchCitiesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBranchCities::route('/'),
            'create' => CreateBranchCity::route('/create'),
            'edit' => EditBranchCity::route('/{record}/edit'),
        ];
    }
}
