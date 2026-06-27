<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$resources = [
    App\Filament\Admin\Resources\Pages\PageResource::class,
    App\Filament\Admin\Resources\Services\ServiceResource::class,
    App\Filament\Admin\Resources\SiteSettings\SiteSettingResource::class,
    App\Filament\Admin\Resources\Menus\MenuResource::class,
];

foreach ($resources as $resource) {
    echo $resource::getNavigationGroup() . ' / ' . $resource::getNavigationLabel() . ' / ' . $resource::getModelLabel() . PHP_EOL;
}

echo App\Filament\Admin\Pages\Dashboard::getNavigationLabel() . PHP_EOL;
