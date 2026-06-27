<?php

namespace App\Filament\Admin\Pages;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class Login extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('账号')
            ->required()
            ->autocomplete()
            ->autofocus();
    }
}
