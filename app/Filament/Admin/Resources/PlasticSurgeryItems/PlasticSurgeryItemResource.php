<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryItems;

use App\Filament\Admin\Resources\PlasticSurgeryItems\Pages\CreatePlasticSurgeryItem;
use App\Filament\Admin\Resources\PlasticSurgeryItems\Pages\EditPlasticSurgeryItem;
use App\Filament\Admin\Resources\PlasticSurgeryItems\Pages\ListPlasticSurgeryItems;
use App\Filament\Admin\Resources\PlasticSurgeryItems\Schemas\PlasticSurgeryItemForm;
use App\Filament\Admin\Resources\PlasticSurgeryItems\Tables\PlasticSurgeryItemsTable;
use App\Models\PageSection;
use App\Models\SectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PlasticSurgeryItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $modelLabel = '列表内容';

    protected static ?string $pluralModelLabel = '列表内容';

    protected static ?string $navigationLabel = '列表内容';

    protected static ?string $slug = 'plastic-surgery-items';

    protected static string|\UnitEnum|null $navigationGroup = '整形外科';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('section.page', fn (Builder $query) => $query->where('slug', 'plastic-surgery'))
            ->whereHas('section', fn (Builder $query) => $query->where('type', 'plastic_services'));
    }

    public static function form(Schema $schema): Schema
    {
        return PlasticSurgeryItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlasticSurgeryItemsTable::configure($table);
    }

    public static function getPlasticSectionId(): ?int
    {
        return PageSection::query()
            ->where('type', 'plastic_services')
            ->whereHas('page', fn (Builder $query) => $query->where('slug', 'plastic-surgery'))
            ->value('id');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlasticSurgeryItems::route('/'),
            'create' => CreatePlasticSurgeryItem::route('/create'),
            'edit' => EditPlasticSurgeryItem::route('/{record}/edit'),
        ];
    }
}
