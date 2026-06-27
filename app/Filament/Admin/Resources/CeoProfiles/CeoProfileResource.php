<?php

namespace App\Filament\Admin\Resources\CeoProfiles;

use App\Filament\Admin\Resources\CeoProfiles\Pages\EditCeoProfile;
use App\Filament\Admin\Resources\CeoProfiles\Pages\ListCeoProfiles;
use App\Filament\Admin\Resources\CeoProfiles\Schemas\CeoProfileForm;
use App\Filament\Admin\Resources\CeoProfiles\Tables\CeoProfilesTable;
use App\Models\PageSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CeoProfileResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $modelLabel = '首席执行员个人履历';

    protected static ?string $pluralModelLabel = '首席执行员个人履历';

    protected static ?string $navigationLabel = '首席执行员个人履历';

    protected static string|\UnitEnum|null $navigationGroup = '关于我们';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('page', fn (Builder $query) => $query->where('slug', 'ceo'))
            ->whereIn('type', [
                'ceo_hero',
                'ceo_profile',
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return CeoProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CeoProfilesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCeoProfiles::route('/'),
            'edit' => EditCeoProfile::route('/{record}/edit'),
        ];
    }
}
