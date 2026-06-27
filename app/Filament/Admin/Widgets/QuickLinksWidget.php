<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Branches\BranchResource;
use App\Filament\Admin\Resources\ContactCtas\ContactCtaResource;
use App\Filament\Admin\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Admin\Resources\Doctors\DoctorResource;
use App\Filament\Admin\Resources\FooterMenuItems\FooterMenuItemResource;
use App\Filament\Admin\Resources\MenuItems\MenuItemResource;
use App\Filament\Admin\Resources\SeoMetas\SeoMetaResource;
use App\Filament\Admin\Resources\SiteSettings\SiteSettingResource;
use Filament\Widgets\Widget;

class QuickLinksWidget extends Widget
{
    protected static ?int $sort = 30;

    protected int|string|array $columnSpan = 1;

    protected string $view = 'filament.admin.widgets.quick-links';

    protected function getViewData(): array
    {
        return [
            'heading' => '快捷入口',
            'links' => [
                ['label' => '内容管理', 'url' => SiteSettingResource::getNavigationUrl()],
                ['label' => 'SEO管理', 'url' => SeoMetaResource::getNavigationUrl()],
                ['label' => '顶部导航', 'url' => MenuItemResource::getUrl('index')],
                ['label' => '底部导航', 'url' => FooterMenuItemResource::getUrl('index')],
                ['label' => '用户信息管理', 'url' => ContactSubmissionResource::getUrl('index')],
                ['label' => '表单信息管理', 'url' => ContactCtaResource::getUrl('index')],
                ['label' => '医生管理', 'url' => DoctorResource::getUrl('index')],
                ['label' => '分行管理', 'url' => BranchResource::getUrl('index')],
            ],
        ];
    }
}
