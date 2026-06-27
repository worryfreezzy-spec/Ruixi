<?php

namespace App\Filament\Admin\Resources\ContactSubmissions;

use App\Filament\Admin\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Filament\Admin\Resources\ContactSubmissions\Pages\ViewContactSubmission;
use App\Filament\Admin\Resources\ContactSubmissions\Schemas\ContactSubmissionInfolist;
use App\Filament\Admin\Resources\ContactSubmissions\Tables\ContactSubmissionsTable;
use App\Models\ContactSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $modelLabel = '用户信息';

    protected static ?string $pluralModelLabel = '用户信息管理';

    protected static ?string $navigationLabel = '用户信息管理';

    protected static string|\UnitEnum|null $navigationGroup = '表单管理';

    protected static ?int $navigationSort = 150;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactSubmissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactSubmissionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactSubmissions::route('/'),
            'view' => ViewContactSubmission::route('/{record}'),
        ];
    }
}
