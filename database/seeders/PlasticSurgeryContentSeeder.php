<?php

namespace Database\Seeders;

use App\Models\ContactCta;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use Illuminate\Database\Seeder;

class PlasticSurgeryContentSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'plastic-surgery'],
            [
                'title' => '整形外科和美容服务',
                'template' => 'plastic_surgery',
                'hero_title' => '',
                'hero_image' => 'static/image/hero35.webp',
                'breadcrumb_title' => 'OPTIMAX 新服务 /',
                'summary' => '欢迎来到一个更加美丽和幸福的世界。我们很高兴推出我们扩展的服务套件，其中包括全面的整形手术和美容增强服务。我们的专家团队始终致力于提供广泛的美容手术，提供个性化的解决方案来满足您的独特需求和目标。无论您是考虑进行双眼皮手术、面部除皱还是非手术治疗，我们都会为您提供每一步的指导。',
                'sort_order' => 50,
                'is_active' => true,
            ],
        );

        $section = PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'plastic_services'],
            [
                'title' => '服务清单',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        SectionItem::query()->where('section_id', $section->id)->delete();

        foreach ([
            ['上下眼睑手术、开眼角手术', '双眼皮手术、去眼袋手术、眼睛扩大手术', 'static/picture/ps1.webp', 1],
            ['鼻整形术', null, 'static/picture/ps2.webp', 2],
            ['唇部整形、颊脂垫去除', null, 'static/picture/ps3.webp', 3],
            ['面部和颈部提升、眉毛提升、脂肪移植面部年轻化', null, 'static/picture/ps4.webp', 4],
            ['丰胸、乳房提升和乳房缩小术。 乳头和乳晕重塑。 男性乳房发育症手术', null, 'static/picture/ps5.webp', 5],
            ['高清吸脂术、腹部整形术（腹部除皱术）、臀部脂肪填充术（臀部提升术）', null, 'static/picture/ps6.webp', 6],
            ['阴唇整形手术', null, 'static/picture/ps7.webp', 7],
            ['非手术程序', '肉毒杆菌和填充剂注射、埋线提升', 'static/picture/ps8.webp', 8],
        ] as [$title, $description, $image, $sortOrder]) {
            SectionItem::query()->create([
                'section_id' => $section->id,
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'button_url' => '#0',
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);
        }

        ContactCta::query()->updateOrCreate(
            ['key' => 'plastic_surgery'],
            [
                'subtitle' => '进行查询或预约',
                'title' => '今天立即联络我们',
                'description' => '如需咨询、咨询或安排预约，请立即联系我们的团队。 我们随时为您提供帮助，助您实现美丽和幸福。 现在就联系我们，让我们将您的愿望变成现实。',
                'button_text' => '立即联络我们',
                'button_url' => 'contact.html',
                'background_image' => null,
                'show_form' => false,
                'is_active' => true,
            ],
        );
    }
}
