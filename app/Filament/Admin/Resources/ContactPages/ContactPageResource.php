<?php

namespace App\Filament\Admin\Resources\ContactPages;

use App\Filament\Admin\Resources\ContactPages\Pages\EditContactPage;
use App\Filament\Admin\Resources\ContactPages\Pages\ListContactPages;
use App\Filament\Admin\Resources\ContactPages\Schemas\ContactPageForm;
use App\Filament\Admin\Resources\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactPageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $modelLabel = '页面管理';

    protected static ?string $pluralModelLabel = '页面管理';

    protected static ?string $navigationLabel = '页面管理';

    protected static ?string $slug = 'contact-pages';

    protected static string|\UnitEnum|null $navigationGroup = '联系我们管理';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('slug', 'contact');
    }

    public static function form(Schema $schema): Schema
    {
        return ContactPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactPages::route('/'),
            'edit' => EditContactPage::route('/{record}/edit'),
        ];
    }
}
