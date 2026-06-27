<?php

namespace App\Filament\Admin\Resources\ServiceSections;

use App\Filament\Admin\Resources\ServiceSections\Pages\CreateServiceSection;
use App\Filament\Admin\Resources\ServiceSections\Pages\EditServiceSection;
use App\Filament\Admin\Resources\ServiceSections\Pages\ListServiceSections;
use App\Filament\Admin\Resources\ServiceSections\Pages\ViewServiceSection;
use App\Filament\Admin\Resources\ServiceSections\Schemas\ServiceSectionForm;
use App\Filament\Admin\Resources\ServiceSections\Schemas\ServiceSectionInfolist;
use App\Filament\Admin\Resources\ServiceSections\Tables\ServiceSectionsTable;
use App\Models\ServiceSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceSectionResource extends Resource
{
    protected static ?string $model = ServiceSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $modelLabel = '服务详情区块';

    protected static ?string $pluralModelLabel = '服务详情区块';

    protected static ?string $navigationLabel = '服务详情区块';

    protected static string | \UnitEnum | null $navigationGroup = '服务管理';

    protected static ?int $navigationSort = 90;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereDoesntHave('service.category', fn (Builder $query) => $query->whereIn('slug', ['cataract', 'eye-diseases']));
    }

    public static function form(Schema $schema): Schema
    {
        return ServiceSectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceSectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSectionsTable::configure($table);
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
            'index' => ListServiceSections::route('/'),
            'create' => CreateServiceSection::route('/create'),
            'view' => ViewServiceSection::route('/{record}'),
            'edit' => EditServiceSection::route('/{record}/edit'),
        ];
    }
}

