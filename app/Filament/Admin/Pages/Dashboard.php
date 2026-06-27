<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\ContentOverviewWidget;
use App\Filament\Admin\Widgets\FrontendLinksWidget;
use App\Filament\Admin\Widgets\PendingSubmissionsWidget;
use App\Filament\Admin\Widgets\QuickLinksWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = '控制台';

    protected static ?string $title = '控制台';

    public function getWidgets(): array
    {
        return [
            PendingSubmissionsWidget::class,
            ContentOverviewWidget::class,
            QuickLinksWidget::class,
            FrontendLinksWidget::class,
        ];
    }
}
