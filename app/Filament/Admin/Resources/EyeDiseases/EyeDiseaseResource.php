<?php

namespace App\Filament\Admin\Resources\EyeDiseases;

use App\Filament\Admin\Resources\EyeDiseases\Pages\CreateEyeDisease;
use App\Filament\Admin\Resources\EyeDiseases\Pages\EditEyeDisease;
use App\Filament\Admin\Resources\EyeDiseases\Pages\ListEyeDiseases;
use App\Filament\Admin\Resources\EyeDiseases\Pages\ViewEyeDisease;
use App\Filament\Admin\Resources\EyeDiseases\Schemas\EyeDiseaseForm;
use App\Filament\Admin\Resources\EyeDiseases\Schemas\EyeDiseaseInfolist;
use App\Filament\Admin\Resources\EyeDiseases\Tables\EyeDiseasesTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EyeDiseaseResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $modelLabel = '疾病文章';

    protected static ?string $pluralModelLabel = '疾病列表';

    protected static ?string $navigationLabel = '疾病列表';

    protected static string|\UnitEnum|null $navigationGroup = '眼睛疾病';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('category', fn (Builder $query) => $query->where('slug', 'eye-diseases'));
    }

    public static function form(Schema $schema): Schema
    {
        return EyeDiseaseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EyeDiseaseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EyeDiseasesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEyeDiseases::route('/'),
            'create' => CreateEyeDisease::route('/create'),
            'view' => ViewEyeDisease::route('/{record}'),
            'edit' => EditEyeDisease::route('/{record}/edit'),
        ];
    }
}
