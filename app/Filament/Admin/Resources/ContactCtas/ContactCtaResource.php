<?php

namespace App\Filament\Admin\Resources\ContactCtas;

use App\Filament\Admin\Resources\ContactCtas\Pages\CreateContactCta;
use App\Filament\Admin\Resources\ContactCtas\Pages\EditContactCta;
use App\Filament\Admin\Resources\ContactCtas\Pages\ListContactCtas;
use App\Filament\Admin\Resources\ContactCtas\Schemas\ContactCtaForm;
use App\Filament\Admin\Resources\ContactCtas\Tables\ContactCtasTable;
use App\Models\ContactCta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactCtaResource extends Resource
{
    protected static ?string $model = ContactCta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;

    protected static ?string $modelLabel = '表单信息';

    protected static ?string $pluralModelLabel = '表单信息管理';

    protected static ?string $navigationLabel = '表单信息管理';

    protected static string|\UnitEnum|null $navigationGroup = '表单管理';

    protected static ?int $navigationSort = 140;

    public static function form(Schema $schema): Schema
    {
        return ContactCtaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactCtasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactCtas::route('/'),
            'create' => CreateContactCta::route('/create'),
            'edit' => EditContactCta::route('/{record}/edit'),
        ];
    }
}
