<?php

namespace App\Filament\Admin\Resources\ContactFormFields;

use App\Filament\Admin\Resources\ContactFormFields\Pages\CreateContactFormField;
use App\Filament\Admin\Resources\ContactFormFields\Pages\EditContactFormField;
use App\Filament\Admin\Resources\ContactFormFields\Pages\ListContactFormFields;
use App\Filament\Admin\Resources\ContactFormFields\Pages\ViewContactFormField;
use App\Filament\Admin\Resources\ContactFormFields\Schemas\ContactFormFieldForm;
use App\Filament\Admin\Resources\ContactFormFields\Schemas\ContactFormFieldInfolist;
use App\Filament\Admin\Resources\ContactFormFields\Tables\ContactFormFieldsTable;
use App\Models\ContactFormField;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactFormFieldResource extends Resource
{
    protected static ?string $model = ContactFormField::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $modelLabel = '表单字段';

    protected static ?string $pluralModelLabel = '表单字段';

    protected static ?string $navigationLabel = '表单字段';

    protected static string | \UnitEnum | null $navigationGroup = '表单管理';

    protected static ?int $navigationSort = 160;


    public static function form(Schema $schema): Schema
    {
        return ContactFormFieldForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactFormFieldInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactFormFieldsTable::configure($table);
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
            'index' => ListContactFormFields::route('/'),
            'create' => CreateContactFormField::route('/create'),
            'view' => ViewContactFormField::route('/{record}'),
            'edit' => EditContactFormField::route('/{record}/edit'),
        ];
    }
}

