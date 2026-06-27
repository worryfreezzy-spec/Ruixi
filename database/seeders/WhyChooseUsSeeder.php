<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        $about = Page::query()->where('slug', 'about')->first();

        $page = Page::query()->updateOrCreate(
            ['slug' => 'why-choose-us'],
            [
                'parent_id' => $about?->id,
                'title' => '为何选择我们？ | OPTIMAX 眼睛专科中心',
                'template' => 'why-choose-us',
                'hero_title' => '为何选择我们？',
                'breadcrumb_title' => '为何选择我们？',
                'summary' => '了解 OPTIMAX 的专业优势、技术、服务网络和眼科医疗经验。',
                'is_active' => true,
                'sort_order' => 40,
            ],
        );

        $hero = PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'why_choose_hero'],
            [
                'title' => '为何选择我们？',
                'image' => 'about/hero9.jpg',
                'sort_order' => 0,
                'is_active' => true,
            ],
        );

        $icons = PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'why_choose_icons'],
            [
                'title' => '为何选择我们？',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        $advantages = PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'optimax_advantages'],
            [
                'title' => 'OPTIMAX的强大优势',
                'subtitle' => '您可以信任我们的几个理由:',
                'sort_order' => 2,
                'is_active' => true,
            ],
        );

        $iconItems = [
            ['医生具专业资格及经验丰富', 'section-icons/ico1.png'],
            ['于马来西亚首推全飞秒激光矫视（ReLEx Smile）', 'section-icons/ico2.png'],
            ['拥有强大支援系统及关系网', 'section-icons/ico3.png'],
            ['一站式多元专业治疗', 'section-icons/ico5.png'],
            ['于槟城经营一家私营眼睛专科', 'section-icons/ico7.png'],
            ['ISO 认证', 'section-icons/ico8.png'],
            ['Optimax治疗结果和分析系统（OTRAS)', 'section-icons/ico9.png'],
            ['屡获殊荣的眼睛专科', 'section-icons/ico10.png'],
        ];

        foreach ($iconItems as $index => [$title, $icon]) {
            SectionItem::query()->updateOrCreate(
                ['section_id' => $icons->id, 'title' => $title],
                [
                    'icon' => $icon,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }

        $advantageItems = [
            ['31年的实战专业经验', '自1995年创办以来，我们从激光眼睛手术开始起航，在31年的岁月中，我们专注在专业的眼睛保健领域上精益求精，不断与时并进跟紧创新技术，我们致力于用更多的时间来实践及完善我们的服务流程，让客户得到最顶尖优质的服务。'],
            ['强大支援系统和关系网', "我们拥有覆盖全马主要城市的庞大关系网，让您随时容易与我们接洽。您可以安心及放心将您与家人的任何眼睛问题及保健交托给我们。\n\n您在莎亚南Optimax中心接受手术，但在槟城度假时想顺便接受复诊？没问题，您可以前来我们位于槟岛的Full Fledged眼科专科医院即可，让您可在不影响复诊下享受度假！\n\n您在古晋Optimax中心接受手术，但将会前往新加坡工作？不用担心，只需前往新山的Optimax复诊即可！"],
            ['一站式多元专业治疗—我们竭尽所能做到最好', '若您正在寻找一站式的方案来完全帮助您摆脱沉重眼镜的束缚，在这里，只要您说出您心中想要的眼科保健治疗，我们都一应俱全 – ASA, LASIK, SMILE, ICL, RLE, Ortho-k, RGP。'],
            ['成熟技术及经验证科技', '马来西亚Optimax所提供的治疗方案及专业技术（例如全飞秒激光矫视（Relex SMILE），量身定制飞秒激光矫视（Femto-LASIK））与世界领先最著名的眼睛专科中心所采用的方案及技术是相同的，我们与世界顶尖眼睛专科拥有同等规格的科技。现在您无需耗资庞大的费用飞往其他国家，即可在马来西亚的Optimax享用同样世界等级的专业技术及高端设备。'],
            ['获得来自世界顶尖机构的认可', '我们拥有ISO认证，这验证了我们与全球少数顶尖精英的眼科激光中心拥有同等的规格。在马来西亚，并不容易找到取得ISO认证的世界级激光眼睛专科中心，而在Optimax，将符合您一切的专业所求。'],
            ['审核治疗疗成效', '我们拥有内部审核员，以确保对治疗成效进行独立和客观的评估，以保证客户可获得最佳的眼部护理体验，我们的服务使命不仅仅是最好，而是更好。'],
        ];

        foreach ($advantageItems as $index => [$title, $description]) {
            SectionItem::query()->updateOrCreate(
                ['section_id' => $advantages->id, 'title' => $title],
                [
                    'description' => $description,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }

        Menu::query()
            ->where('location', 'header')
            ->get()
            ->each(function (Menu $menu): void {
                $menu->items()->where('title', '为何选择我们？')->update(['url' => 'why-choose-us.html']);
                $menu->items()->where('title', '为何选择我们')->update(['url' => 'why-choose-us.html']);
            });
    }
}
