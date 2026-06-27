<?php

namespace App\Filament\Admin\Resources\CataractServiceSections;

use App\Filament\Admin\Resources\CataractServiceSections\Pages\CreateCataractServiceSection;
use App\Filament\Admin\Resources\CataractServiceSections\Pages\EditCataractServiceSection;
use App\Filament\Admin\Resources\CataractServiceSections\Pages\ListCataractServiceSections;
use App\Filament\Admin\Resources\CataractServiceSections\RelationManagers\ItemsRelationManager;
use App\Filament\Admin\Resources\ServiceSections\Schemas\ServiceSectionForm;
use App\Filament\Admin\Resources\ServiceSections\Tables\ServiceSectionsTable;
use App\Models\ServiceSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CataractServiceSectionResource extends Resource
{
    protected static ?string $model = ServiceSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?string $modelLabel = '白内障文章内容区块';

    protected static ?string $pluralModelLabel = '白内障文章内容区块';

    protected static ?string $navigationLabel = '文章内容区块';

    protected static string|\UnitEnum|null $navigationGroup = '白内障治疗';

    protected static ?int $navigationSort = 30;

    protected static bool $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('service.category', fn (Builder $query) => $query->where('slug', 'cataract'));
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCataractServiceSections::route('/'),
            'create' => CreateCataractServiceSection::route('/create'),
            'edit' => EditCataractServiceSection::route('/{record}/edit'),
        ];
    }
}
