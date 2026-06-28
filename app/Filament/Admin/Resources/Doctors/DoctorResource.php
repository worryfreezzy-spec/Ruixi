<?php

namespace App\Filament\Admin\Resources\Doctors;

use App\Filament\Admin\Resources\Doctors\Pages\CreateDoctor;
use App\Filament\Admin\Resources\Doctors\Pages\EditDoctor;
use App\Filament\Admin\Resources\Doctors\Pages\ListDoctors;
use App\Filament\Admin\Resources\Doctors\Pages\ViewDoctor;
use App\Filament\Admin\Resources\Doctors\Schemas\DoctorForm;
use App\Filament\Admin\Resources\Doctors\Schemas\DoctorInfolist;
use App\Filament\Admin\Resources\Doctors\Tables\DoctorsTable;
use App\Models\Doctor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static ?string $modelLabel = '医生';

    protected static ?string $pluralModelLabel = '医生管理';

    protected static ?string $navigationLabel = '医生管理';

    protected static string | \UnitEnum | null $navigationGroup = '关于我们';

    protected static ?int $navigationSort = 30;


    public static function form(Schema $schema): Schema
    {
        return DoctorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DoctorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DoctorsTable::configure($table);
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
            'index' => ListDoctors::route('/'),
            'create' => CreateDoctor::route('/create'),
            'view' => ViewDoctor::route('/{record}'),
            'edit' => EditDoctor::route('/{record}/edit'),
        ];
    }
}

