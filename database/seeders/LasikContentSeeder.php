<?php

namespace Database\Seeders;

use App\Models\ContactCta;
use App\Models\MenuItem;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSection;
use App\Models\ServiceSectionItem;
use Illuminate\Database\Seeder;

class LasikContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->updateOrCreate(
            ['slug' => 'laser-vision-correction'],
            [
                'title' => '激光矫视',
                'type' => 'lasik',
                'hero_title' => '激光矫视手术',
                'hero_image' => 'static/image/hero12.jpg',
                'intro_title' => '激光屈光治疗',
                'intro_description' => 'OPTIMAX 为您提供广泛及专业的激光视力矫视手术方法',
                'description' => '关于激光视力矫视，即通过激光来改变角膜（眼睛表层）的形状，通过改变角膜弧度，既改变眼睛的屈光度，帮助接受手术者恢复视力。在OPTIMAX，我们致力于为您提供广泛及专业的激光视力矫视方法。',
                'sort_order' => 30,
                'is_active' => true,
            ],
        );

        ContactCta::query()->updateOrCreate(
            ['key' => 'lasik'],
            [
                'subtitle' => '立即注册以进行初步眼睛检查!',
                'title' => '今天立即联络我们',
                'description' => '无论您仅是需要简单的眼睛健康检查，或者想要进行复杂的眼科手术，请安心与我们预约。我们的眼科医生和验光师团队，将竭尽所能满足您对眼睛保健及护理的所有需求。今天即联系我们，我们随时为您提供帮助！',
                'extra_text' => '请在下面填写您的详细信息，我们将尽快与您联系。您也可以直接拨打免费电话 1800 88 1201 与我们联系。',
                'note' => '条款和条件适用.',
                'button_text' => '立即联络我们',
                'button_url' => 'contact.html',
                'background_image' => 'contact/cta2021.jpg',
                'show_form' => true,
                'is_active' => true,
            ],
        );

        $services = [
            ['ZEISS SMILE Pro 2.0', 'ZEISS SMILE Pro 2.0', 'zeiss-smile-pro', 'static/picture/zeisspro.webp', 1],
            ['PRESBYOND® 2.0 Laser Blended Vision', 'PRESBYOND<sup>®</sup>2.0 视觉融合激光', 'presbyond', 'static/picture/presbyond2.webp', 2],
            ['全飞秒激光ReLEx SMILE', '全飞秒激光ReLEx SMILE', 'relex-smile', 'static/picture/lasik-relex.jpg', 3],
            ['CLEAR Max', 'CLEAR Max', 'clearmax', 'static/picture/clear1.webp', 4],
            ['量身定制飞秒激光矫视 (Femto-LASIK)', '量身定制飞秒激光矫视 (Femto-LASIK)', 'femto-lasik', 'static/picture/lasik-femto.jpg', 5],
            ['定制先进激光--激光角膜表层切削术 (ASA)', '定制先进激光--激光角膜表层切削术 (ASA)', 'advanced-surface-ablation', 'static/picture/lasik-asa.jpg', 6],
            ['量身定制的 TESA', '量身定制的 TESA', 'tesa-s', 'static/picture/lasik-tesa.jpg', 7],
            ['可植入式隐形眼镜(ICL)', '可植入式隐形眼镜(ICL)', 'implantable-collamer-lens', 'static/picture/lasik-icl.jpg', 8],
            ['硬性透氧性隐形眼镜(RGP)', '硬性透氧性隐形眼镜(RGP)', 'rigid-gas-permeable-lenses', 'static/picture/lasik-rgp.jpg', 9],
        ];

        foreach ($services as [$title, $shortTitle, $slug, $thumbnail, $sortOrder]) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $title,
                    'short_title' => $shortTitle,
                    'summary' => strip_tags($shortTitle),
                    'hero_image' => 'static/image/hero36.webp',
                    'thumbnail' => $thumbnail,
                    'intro_title' => $shortTitle,
                    'intro_description' => '相关详情内容可在后台「激光矫视 → 矫视列表」中补充维护。',
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ],
            );
        }

        $presbyond = Service::query()->updateOrCreate(
            ['slug' => 'presbyond'],
            [
                'category_id' => $category->id,
                'title' => 'PRESBYOND2.0视觉融合激光',
                'short_title' => 'PRESBYOND<sup>®</sup>2.0视觉融合激光',
                'summary' => 'PRESBYOND2.0视觉融合激光是一种先进而有效的手术解决方案，用于老视眼。',
                'hero_image' => 'static/image/hero36.webp',
                'thumbnail' => 'static/picture/presbyond2.webp',
                'intro_title' => 'PRESBYOND<sup>®</sup>2.0视觉融合激光',
                'intro_description' => 'PRESBYOND®2.0视觉融合激光是一种先进而有效的手术解决方案，用于老视眼，即因年龄增长导致的调节能力丧失，从而导致阅读困难。这种激光近视手术方案在所有距离上都能提供良好的视力，包括近距离、远距离和中距离，让个体摆脱眼镜和隐形眼镜的束缚。',
                'benefits_title' => 'PRESBYOND®2.0 的独特之处在于将双眼分别对远视力和近视力进行单独优化，扩展了双眼焦点范围。这种整合使患者能够在近距离、中距离和远距离获得良好的视力，无需佩戴眼镜，并考虑术前波前数据和患者眼睛的功能年龄。',
                'right_title' => 'PRESBYOND<sup>®</sup>2.0有什么特别之处？',
                'left_title' => '程序',
                'left_description' => "1. 在飞秒激光矫视手术中，将会运用飞秒激光在角膜上制瓣。\n2. 后轻抬起瓣层，并露出角膜内层。\n3. 采用准分子激光用于重塑角膜内层，以恢复眼睛的视力。\n4. 一旦完成准分子激光治疗后，将角膜瓣轻盖回原来位置。",
                'left_image' => 'static/picture/presbyond.webp',
                'detail_media' => 'static/video/presbyond.mp4',
                'advantages_title' => '优势',
                'advantages_content' => "- 安全\n- 无刀\n- 无痛且快速的手术\n- 定制\n- 较短的手术时间\n- 快速康复\n- 更高的精确度\n- 易于适应",
                'audience_title' => '适合人选：',
                'audience_content' => "- 超过40岁，开始感到阅读困难的人 同时也希望矫正近视和散光。\n- 倾向于选择非传统的单视矫正方法的人。",
                'sort_order' => 2,
                'is_active' => true,
            ],
        );

        ServiceSection::query()->where('service_id', $presbyond->id)->get()->each(function (ServiceSection $section): void {
            $section->items()->delete();
            $section->delete();
        });

        $procedure = ServiceSection::query()->create([
            'service_id' => $presbyond->id,
            'type' => 'feature_split',
            'title' => '程序',
            'subtitle' => 'PRESBYOND<sup>®</sup>2.0有什么特别之处？',
            'description' => "1. 在飞秒激光矫视手术中，将会运用飞秒激光在角膜上制瓣。\n2. 后轻抬起瓣层，并露出角膜内层。\n3. 采用准分子激光用于重塑角膜内层，以恢复眼睛的视力。\n4. 一旦完成准分子激光治疗后，将角膜瓣轻盖回原来位置。",
            'image' => 'static/picture/presbyond.webp',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        foreach ([
            ['步骤1：飞秒激光制成角膜瓣', 'static/picture/pro-femto1.png', 1],
            ['步骤2：使用定制的激光矫正以矫正现有的视力', 'static/picture/pro-custom2.png', 2],
            ['步骤3：将角膜瓣轻盖回原来位置', 'static/picture/pro-custom3.png', 3],
        ] as [$title, $image, $sortOrder]) {
            ServiceSectionItem::query()->create([
                'service_section_id' => $procedure->id,
                'title' => $title,
                'image' => $image,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);
        }

        $benefits = ServiceSection::query()->create([
            'service_id' => $presbyond->id,
            'type' => 'blue_columns',
            'title' => '优势',
            'description' => "- 安全\n- 无刀\n- 无痛且快速的手术\n- 定制\n- 较短的手术时间\n- 快速康复\n- 更高的精确度\n- 易于适应",
            'sort_order' => 2,
            'is_active' => true,
        ]);

        ServiceSectionItem::query()->create([
            'service_section_id' => $benefits->id,
            'title' => '适合人选：',
            'description' => "- 超过40岁，开始感到阅读困难的人，同时也希望矫正近视和散光。\n- 倾向于选择非传统的单视矫正方法的人。",
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->updateMenuUrls();
    }

    private function updateMenuUrls(): void
    {
        $items = [
            '激光矫视' => 'laser-vision-correction.html',
            'Presbyond®2.0 视觉融合激光' => 'presbyond.html',
            'Presbyond® 2.0 视觉融合激光' => 'presbyond.html',
            '全飞秒激光' => 'relex-smile.html',
            'CLEAR Max' => 'clearmax.html',
            '飞秒激光矫视' => 'femto-lasik.html',
            '激光角膜表层切削术 (ASA)' => 'advanced-surface-ablation.html',
            '量身定制的 TESA®' => 'tesa-s.html',
            '可植入式隐形眼镜 (ICL)' => 'implantable-collamer-lens.html',
            '硬性透氧性隐形眼镜 (RGP)' => 'rigid-gas-permeable-lenses.html',
        ];

        foreach ($items as $title => $url) {
            MenuItem::query()->where('title', $title)->update(['url' => $url]);
        }
    }
}
