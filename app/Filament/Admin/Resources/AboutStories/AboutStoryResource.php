<?php

namespace App\Filament\Admin\Resources\AboutStories;

use App\Filament\Admin\Resources\AboutStories\Pages\EditAboutStory;
use App\Filament\Admin\Resources\AboutStories\Pages\ListAboutStories;
use App\Filament\Admin\Resources\AboutStories\Schemas\AboutStoryForm;
use App\Filament\Admin\Resources\AboutStories\Tables\AboutStoriesTable;
use App\Models\PageSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AboutStoryResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = '我们的故事';

    protected static ?string $pluralModelLabel = '我们的故事';

    protected static ?string $navigationLabel = '我们的故事';

    protected static string|\UnitEnum|null $navigationGroup = '关于我们';

    protected static ?int $navigationSort = 10;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('page', fn (Builder $query) => $query->where('slug', 'about'))
            ->whereIn('type', [
                'about_hero',
                'about_intro',
                'about_humble',
                'about_innovation',
                'about_people',
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return AboutStoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutStoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutStories::route('/'),
            'edit' => EditAboutStory::route('/{record}/edit'),
        ];
    }
}
