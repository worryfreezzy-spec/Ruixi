<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Branches\BranchResource;
use App\Filament\Admin\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Admin\Resources\Doctors\DoctorResource;
use App\Filament\Admin\Resources\SeoMetas\SeoMetaResource;
use App\Models\Branch;
use App\Models\ContactSubmission;
use App\Models\Doctor;
use App\Models\SeoMeta;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 20;

    protected ?string $heading = '网站内容概览';

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('待处理用户信息', ContactSubmission::query()->where('status', 'new')->count())
                ->description('新提交')
                ->url(ContactSubmissionResource::getUrl('index')),
            Stat::make('医生', Doctor::query()->count())
                ->description('医生资料')
                ->url(DoctorResource::getUrl('index')),
            Stat::make('分行', Branch::query()->count())
                ->description('分行资料')
                ->url(BranchResource::getUrl('index')),
            Stat::make('白内障文章', $this->serviceCount('cataract'))
                ->description('服务文章'),
            Stat::make('眼睛疾病文章', $this->serviceCount('eye-diseases'))
                ->description('疾病文章'),
            Stat::make('激光矫视文章', $this->serviceCount('laser-vision-correction'))
                ->description('矫视文章'),
            Stat::make('儿童文章', $this->serviceCount('kids'))
                ->description('儿童眼科'),
            Stat::make('SEO页面', SeoMeta::query()->count())
                ->description('已创建 SEO')
                ->url(SeoMetaResource::getNavigationUrl()),
        ];
    }

    private function serviceCount(string $categorySlug): int
    {
        return Service::query()
            ->whereHas('category', fn ($query) => $query->where('slug', $categorySlug))
            ->count();
    }
}
