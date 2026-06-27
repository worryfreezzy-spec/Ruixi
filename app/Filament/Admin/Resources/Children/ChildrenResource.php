<?php

namespace App\Filament\Admin\Resources\Children;

use App\Filament\Admin\Resources\Children\Pages\CreateChild;
use App\Filament\Admin\Resources\Children\Pages\EditChild;
use App\Filament\Admin\Resources\Children\Pages\ListChildren;
use App\Filament\Admin\Resources\Children\Pages\ViewChild;
use App\Filament\Admin\Resources\Children\Schemas\ChildForm;
use App\Filament\Admin\Resources\Children\Tables\ChildrenTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChildrenResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $modelLabel = '儿童文章';

    protected static ?string $pluralModelLabel = '儿童管理';

    protected static ?string $navigationLabel = '儿童管理';

    protected static string|\UnitEnum|null $navigationGroup = '儿童';

    protected static ?int $navigationSort = 20;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('category', fn (Builder $query) => $query->where('slug', 'kids'));
    }

    public static function form(Schema $schema): Schema
    {
        return ChildForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChildrenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChildren::route('/'),
            'create' => CreateChild::route('/create'),
            'view' => ViewChild::route('/{record}'),
            'edit' => EditChild::route('/{record}/edit'),
        ];
    }
}
