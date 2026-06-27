<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class FrontendLinksWidget extends Widget
{
    protected static ?int $sort = 40;

    protected int|string|array $columnSpan = 1;

    protected string $view = 'filament.admin.widgets.quick-links';

    protected function getViewData(): array
    {
        return [
            'heading' => '前台快捷访问',
            'openInNewTab' => true,
            'links' => [
                ['label' => '查看首页', 'url' => url('/')],
                ['label' => '联系我们', 'url' => url('contact.html')],
                ['label' => '医生列表', 'url' => url('doctors.html')],
                ['label' => '激光矫视', 'url' => url('laser-vision-correction.html')],
                ['label' => '白内障治疗', 'url' => url('cataract.html')],
                ['label' => '眼睛疾病', 'url' => url('eye-diseases-management.html')],
                ['label' => '儿童眼科', 'url' => url('kids.html')],
                ['label' => '整形外科', 'url' => url('plastic-surgery.html')],
            ],
        ];
    }
}
