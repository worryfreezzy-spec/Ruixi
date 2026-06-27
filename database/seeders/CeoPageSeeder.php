<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class CeoPageSeeder extends Seeder
{
    public function run(): void
    {
        $about = Page::query()->where('slug', 'about')->first();

        $page = Page::query()->updateOrCreate(
            ['slug' => 'ceo'],
            [
                'parent_id' => $about?->id,
                'title' => '了解我们的首席执行员 - OPTIMAX',
                'template' => 'ceo',
                'hero_title' => '了解我们的首席执行员',
                'breadcrumb_title' => '首席执行员个人履历',
                'summary' => '毕业于法学荣誉学位的Sandy Tan，在Optimax眼睛专科中心致力于整合企业的团队营销，提高公司的品牌形象，为最终消费者创造最大的价值。',
                'is_active' => true,
                'sort_order' => 20,
            ],
        );

        $sections = [
            [
                'type' => 'ceo_hero',
                'title' => '了解我们的首席执行员',
                'image' => 'about/ceo.webp',
                'sort_order' => 0,
            ],
            [
                'type' => 'ceo_profile',
                'title' => '首席执行员个人履历 - Sandy Tan',
                'subtitle' => '毕业于法学荣誉学位的Sandy Tan，在Optimax眼睛专科中心致力于整合企业的团队营销，提高公司的品牌形象，为最终消费者创造最大的价值，使企业从中获得长远发展和长期利润。',
                'description' => "营运及营销部门是她奠定事业基础的启航点，累积了来自各领域的工作经验，包括本地金融机构的资本市场和股权部门的经验。\n\nSandy 一直以来擅于“左脑”思考或逻辑思维的分析和客观工作，随后她也决定为自己寻求更大的人生突破，为自己在创意方面的思维增值，前往伦敦攻读时装设计课程。在毕业后，她返回家乡吉隆坡并加入了本土时装品牌的采购及销售部门发挥其专业，该品牌在本区域拥有40个销售点，各项种类任务驱使Sandy成为了一个全能领导者。\n\n在Optimax眼睛专科中心，Sandy将毕生所学及过去工作累计的丰富营销经验，极力拓展业务发展活动和实施集团营销策略，她强调营销方式的完整性和营销主体的整体性，成了公司核心的领导人物。她与生俱来具有的市场营销天赋和对工艺的热情逐渐彰显，在事事全力以赴及努力下赢得了董事会的信任，并在2015年起获委任为首席执行员。\n\nSandy强调“以人为本”的性格，帮助企业取得凝聚力，而她也一直努力实现生活上的愿景和使命，促使人生及事业走在正确的轨道上。",
                'sort_order' => 1,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::query()->updateOrCreate(
                ['page_id' => $page->id, 'type' => $section['type']],
                [
                    ...$section,
                    'is_active' => true,
                ],
            );
        }

        Menu::query()
            ->where('location', 'header')
            ->get()
            ->each(function (Menu $menu): void {
                $aboutItem = $menu->items()->where('title', '关于我们')->whereNull('parent_id')->first();

                if (! $aboutItem) {
                    return;
                }

                $menu->items()->updateOrCreate(
                    [
                        'parent_id' => $aboutItem->id,
                        'title' => '首席执行员个人履历',
                    ],
                    [
                        'url' => 'ceo.html',
                        'target' => '_self',
                        'sort_order' => 20,
                        'is_active' => true,
                    ],
                );
            });
    }
}
