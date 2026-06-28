<?php

namespace App\Filament\Admin\Resources\ContactForms;

use App\Filament\Admin\Resources\ContactForms\Pages\CreateContactForm;
use App\Filament\Admin\Resources\ContactForms\Pages\EditContactForm;
use App\Filament\Admin\Resources\ContactForms\Pages\ListContactForms;
use App\Filament\Admin\Resources\ContactForms\Pages\ViewContactForm;
use App\Filament\Admin\Resources\ContactForms\Schemas\ContactFormForm;
use App\Filament\Admin\Resources\ContactForms\Schemas\ContactFormInfolist;
use App\Filament\Admin\Resources\ContactForms\Tables\ContactFormsTable;
use App\Models\ContactForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactFormResource extends Resource
{
    protected static ?string $model = ContactForm::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static ?string $modelLabel = '联系表单';

    protected static ?string $pluralModelLabel = '联系表单';

    protected static ?string $navigationLabel = '联系表单';

    protected static string | \UnitEnum | null $navigationGroup = '表单管理';

    protected static ?int $navigationSort = 150;


    public static function form(Schema $schema): Schema
    {
        return ContactFormForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactFormInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactFormsTable::configure($table);
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
            'index' => ListContactForms::route('/'),
            'create' => CreateContactForm::route('/create'),
            'view' => ViewContactForm::route('/{record}'),
            'edit' => EditContactForm::route('/{record}/edit'),
        ];
    }
}

