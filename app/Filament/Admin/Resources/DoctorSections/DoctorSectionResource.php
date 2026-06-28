<?php

namespace App\Filament\Admin\Resources\DoctorSections;

use App\Filament\Admin\Resources\DoctorSections\Pages\CreateDoctorSection;
use App\Filament\Admin\Resources\DoctorSections\Pages\EditDoctorSection;
use App\Filament\Admin\Resources\DoctorSections\Pages\ListDoctorSections;
use App\Filament\Admin\Resources\DoctorSections\Pages\ViewDoctorSection;
use App\Filament\Admin\Resources\DoctorSections\Schemas\DoctorSectionForm;
use App\Filament\Admin\Resources\DoctorSections\Schemas\DoctorSectionInfolist;
use App\Filament\Admin\Resources\DoctorSections\Tables\DoctorSectionsTable;
use App\Models\DoctorSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DoctorSectionResource extends Resource
{
    protected static ?string $model = DoctorSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;
    protected static ?string $modelLabel = '医生资料区块';

    protected static ?string $pluralModelLabel = '医生资料区块';

    protected static ?string $navigationLabel = '医生资料区块';

    protected static string | \UnitEnum | null $navigationGroup = '医生管理';

    protected static ?int $navigationSort = 120;

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Schema $schema): Schema
    {
        return DoctorSectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DoctorSectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DoctorSectionsTable::configure($table);
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
            'index' => ListDoctorSections::route('/'),
            'create' => CreateDoctorSection::route('/create'),
            'view' => ViewDoctorSection::route('/{record}'),
            'edit' => EditDoctorSection::route('/{record}/edit'),
        ];
    }
}

