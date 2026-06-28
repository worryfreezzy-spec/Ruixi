<?php

namespace App\Filament\Admin\Resources\OptimaxAdvantages;

use App\Filament\Admin\Resources\OptimaxAdvantages\Pages\CreateOptimaxAdvantage;
use App\Filament\Admin\Resources\OptimaxAdvantages\Pages\EditOptimaxAdvantage;
use App\Filament\Admin\Resources\OptimaxAdvantages\Pages\ListOptimaxAdvantages;
use App\Filament\Admin\Resources\OptimaxAdvantages\Schemas\OptimaxAdvantageForm;
use App\Filament\Admin\Resources\OptimaxAdvantages\Tables\OptimaxAdvantagesTable;
use App\Models\PageSection;
use App\Models\SectionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OptimaxAdvantageResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $modelLabel = 'OPTIMAX的强大优势';

    protected static ?string $pluralModelLabel = 'OPTIMAX的强大优势';

    protected static ?string $navigationLabel = 'OPTIMAX的强大优势';

    protected static string|\UnitEnum|null $navigationGroup = '关于我们';

    protected static ?int $navigationSort = 40;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('section', fn (Builder $query) => $query->where('type', 'optimax_advantages'));
    }

    public static function form(Schema $schema): Schema
    {
        return OptimaxAdvantageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OptimaxAdvantagesTable::configure($table);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['section_id'] = PageSection::query()
            ->where('type', 'optimax_advantages')
            ->whereHas('page', fn (Builder $query) => $query->where('slug', 'why-choose-us'))
            ->value('id');

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOptimaxAdvantages::route('/'),
            'create' => CreateOptimaxAdvantage::route('/create'),
            'edit' => EditOptimaxAdvantage::route('/{record}/edit'),
        ];
    }
}
