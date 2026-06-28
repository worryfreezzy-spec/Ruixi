<?php

namespace App\Filament\Admin\Resources\PageSections;

use App\Filament\Admin\Resources\PageSections\Pages\EditPageSection;
use App\Filament\Admin\Resources\PageSections\Pages\ListPageSections;
use App\Filament\Admin\Resources\PageSections\Schemas\PageSectionForm;
use App\Filament\Admin\Resources\PageSections\Schemas\PageSectionInfolist;
use App\Filament\Admin\Resources\PageSections\Tables\PageSectionsTable;
use App\Models\PageSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PageSectionResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static ?string $modelLabel = '页面区块';

    protected static ?string $pluralModelLabel = '页面区块';

    protected static ?string $navigationLabel = '页面区块';

    protected static string|\UnitEnum|null $navigationGroup = '首页内容';

    protected static ?int $navigationSort = 30;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotIn('type', [
                'feature_grid',
                'about_hero',
                'about_intro',
                'about_humble',
                'about_innovation',
                'about_people',
                'award_grid',
                'logo_grid',
                'ceo_hero',
                'ceo_profile',
                'why_choose_hero',
                'why_choose_icons',
                'doctors_intro',
                'optimax_advantages',
                'plastic_services',
                'contact_branches',
                'contact_form',
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return PageSectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PageSectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageSectionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageSections::route('/'),
            'edit' => EditPageSection::route('/{record}/edit'),
        ];
    }
}
