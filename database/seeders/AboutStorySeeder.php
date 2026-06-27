<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class AboutStorySeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => '关于我们',
                'template' => 'about',
                'hero_title' => '我们的故事',
                'breadcrumb_title' => '我们的故事',
                'summary' => '创办31年，已成为东南亚最具盛名的眼睛保健服务专家之一。',
                'is_active' => true,
            ],
        );

        $sections = [
            [
                'type' => 'about_hero',
                'title' => "崭新视野，\n全新人生",
                'sort_order' => 0,
            ],
            [
                'type' => 'about_intro',
                'title' => 'OPTIMAX - 眼睛专科中心',
                'description' => "清晰視力 活出精彩人生 助你开启完美人生无束缚\n沉重的眼镜及累赘的隐形眼镜总束缚着您的灵魂之窗，现在您有开启新视野人生的权利，如同梦想成真般，让您加入“摘镜一族”，让鼻梁和眼睛摆脱沉重束缚，不再紧贴任何眼镜或隐形眼镜，开启您的完美人生！激光视力矫正超越“新市场外科手术”的功能，对许多人而言，这将是完全蜕变你生活体验的机会，犹如重启你的人生！激光手术似乎是一种魔术，它能让多年无法摆脱的大镜框离你远去。\n\nOPTIMAX-眼睛专科中心自1995年创办以来，已成功为超过300,000名客户提供让他们满意的服务。创办31年，OPTIMAX-已成为东南亚最具盛名的眼睛保健服务专家之一，除了拥有庞大的客户群以外，提供更专业及广泛的眼科服务，包括治疗白内障，青光眼，干眼症等各种眼睛疗程。\n\n我们的客户，来自国内外，包括本地及亚洲区域等国家—马来西亚、印尼、菲律宾、新加坡、泰国、澳洲、中国、香港、日本等，这些忠诚客户不惜长途跋涉而来，就为了体验我们的疗程，这恰好显示我们追求卓越手术效果所享有的声誉。",
                'sort_order' => 1,
            ],
            [
                'type' => 'about_humble',
                'title' => '谦卑启航  卓越成长',
                'subtitle' => '我们的创办故事始于1995年，成立于吉隆坡Taman Tun Dr Ismail (TTDI)。从创办至今，我们坚持及了解创办的使命，就是想要做一些特别的事情，可帮助推进人们的前进并让他们生活变得更美好。',
                'description' => '身为马来西亚激光视力矫正的先驱，OPTIMAX 在这31年来，成功扎稳创办使命，通过投资昂贵且高端的科技，我们不断精益求精，进行别人难以想象及前所未闻的高科技医疗，让矫正视力技术能广泛在社区发挥作用。',
                'image' => 'static/picture/hero3@2x.jpg',
                'sort_order' => 2,
            ],
            [
                'type' => 'about_innovation',
                'title' => '激光屈光手术的革新发展',
                'subtitle' => '数十年的持续革新及发展，OPTIMAX和马来西亚的激光屈光手术技术都面对巨大变化，同时也发展出不少新技术和设备。',
                'description' => "从我们一开始在31年前创立时，早期的激光技术是采用一种激光角膜表层切削术（ASA），其也被称为激光屈光角膜切除术（PRK），此手术的视力恢复过程较为缓慢。\n\n随着时间的推移，眼睛激光技术再革新发展进入全新科技，激光原位角膜磨镶术(LASIK) 通过形成角膜瓣所进行的激光手术，术后视力效果可如同激光角膜表层切削术（ASA）/激光屈光角膜切除术（PRK），但恢复时间更快，且病人的不适感较少（ASA/PRK康复时间为数个星期而LASIK则仅需数天）。此角膜瓣是经由自动微型角膜刀（也称为刀片切割器）制成的。\n\n激光技术日益进展，其可更精密电脑控制的飞秒激光来创建更稳健角膜瓣，与传统的与使用微型角膜刀（Blade LASIK）相比，飞秒激光更为精准，安全及快速制作角膜瓣，同时恢复期也短。在精益求精下，今时今日的激光技术发展迅速，可预测的术后疗效及取得更好的效果，让接受手术者可获得更好的视力。\n\n现在，激光技术已发展至最革新的激光手术--Relex SMILE。ReLEx®全飞秒是一种激光矫正视力的革新技术。不同于传统的准分子，该手术无需制瓣且全程仅需使用一种激光（飞秒激光），这将减少手术的术后并发症，减少不适感，同时手术是一步到位，手术时间减少，同时也保留如同激光手术的术后视力效果。",
                'button_text' => '了解我们的疗程',
                'button_url' => 'laser-vision-correction.html',
                'sort_order' => 3,
            ],
            [
                'type' => 'about_people',
                'title' => '以人为本，以客为尊',
                'subtitle' => '自创办以来，我们不断精益求精，为客户寻找更多革新激光技术，以带来更好的效果，我们不断提醒自己，顾客就是支持我们企业的核心支柱，只有真诚地为顾客服务，以顾客需求为中心，并满足顾客的所有需求，才是让我们今日屹立不倒且能茁壮成长的主因。',
                'description' => "OPTIMAX是家私营的公司，为了能够促使我们继续贡献最好的专科人才及高端技术投资，保持盈利是必要的，然而我们依然会谨记我们创办为人们带来更美好未来的初心，及身为医疗服务专家所应负起的社会责任。\n\n多年来，OPTIMAX与我们公司的合作伙伴联合特定的慈善组织，通过赞助白内障手术，提供免费的眼部健康检查以及免费眼部健康教育于弱势群体，帮助他们恢复视力，重展人生。",
                'sort_order' => 4,
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
                $menu->items()->where('title', '关于我们')->whereNull('parent_id')->update(['url' => 'about.html']);
                $menu->items()->where('title', '我们的故事')->update(['url' => 'about.html']);
            });
    }
}
