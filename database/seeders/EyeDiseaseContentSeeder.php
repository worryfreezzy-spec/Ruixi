<?php

namespace Database\Seeders;

use App\Models\ContactCta;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSection;
use App\Models\ServiceSectionItem;
use Illuminate\Database\Seeder;

class EyeDiseaseContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->updateOrCreate(
            ['slug' => 'eye-diseases'],
            [
                'title' => '眼睛疾病',
                'type' => 'eye_disease',
                'hero_title' => '马来西亚眼睛疾病管理',
                'hero_image' => 'static/image/hero30.jpg',
                'intro_title' => '眼睛疾病及其他眼疾状况的管理',
                'intro_description' => '在Optimax，我们专业于各种眼疾的管理。',
                'description' => '在Optimax，我们专业于各种眼疾的管理。',
                'sort_order' => 20,
                'is_active' => true,
            ],
        );

        ContactCta::query()->updateOrCreate(
            ['key' => 'eye_disease'],
            [
                'subtitle' => '进行查询或预约',
                'title' => '今天立即联络我们',
                'description' => '无论您仅是需要简单的眼睛健康检查，或者想要进行复杂的眼科手术，请安心与我们预约。我们的眼科医生和验光师团队，将竭尽所能满足您对眼睛保健及护理的所有需求。今天即联系我们，我们随时为您提供帮助！',
                'button_text' => '立即联络我们',
                'button_url' => 'contact.html',
                'background_image' => 'contact/cta2.jpg',
                'show_form' => false,
                'is_active' => true,
            ],
        );

        $diseases = [
            ['青光眼 | OPTIMAX 眼睛专科中心', '青光眼', 'glaucoma', 'static/picture/glaucoma1.jpg', 1],
            ['干眼症', '干眼症', 'dry-eyes', 'static/picture/dry-eye.jpg', 2],
            ['结膜炎', '结膜炎', 'conjunctivitis', 'static/picture/conjunctivitis.jpg', 3],
            ['糖尿病性视网膜病变', '糖尿病性视网膜病变', 'diabetic-retinopathy', 'static/picture/diabetes.jpg', 4],
            ['老年性黄斑部病变', '老年性黄斑部病变', 'aged-related-macular-degeneration', 'static/picture/amd.jpg', 5],
            ['视网膜脱落', '视网膜脱落', 'retinal-detachment', 'static/picture/retinal-detachment2.jpg', 6],
            ['翼状胬肉', '翼状胬肉', 'pterygium', 'static/picture/pterygium.jpg', 7],
            ['圆锥角膜', '圆锥角膜', 'keratoconus', 'static/picture/keratoconus.jpg', 8],
            ['眼睑疾病', '眼睑疾病', 'ptosis-surgery', 'static/picture/ptosis-p.jpg', 9],
        ];

        foreach ($diseases as [$title, $shortTitle, $slug, $thumbnail, $sortOrder]) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $title,
                    'short_title' => $shortTitle,
                    'summary' => $shortTitle,
                    'intro_title' => $shortTitle,
                    'intro_description' => '相关页面内容可在后台「眼睛疾病 → 疾病列表」中补充维护。',
                    'hero_image' => 'static/image/hero29.jpg',
                    'thumbnail' => $thumbnail,
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ],
            );
        }

        foreach ([
            ['眼睛检查', '眼睛检查', 'eye-examinations', 10],
        ] as [$title, $shortTitle, $slug, $sortOrder]) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $title,
                    'short_title' => $shortTitle,
                    'summary' => $title,
                    'intro_title' => $title,
                    'intro_description' => '相关页面内容可在后台「眼睛疾病 → 疾病列表」中补充维护。',
                    'thumbnail' => null,
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ],
            );
        }

        Service::query()->where('slug', 'eye-screening')->delete();
        MenuItem::query()->where('title', '企业眼科检查')->delete();

        $glaucoma = Service::query()->updateOrCreate(
            ['slug' => 'glaucoma'],
            [
                'category_id' => $category->id,
                'title' => '青光眼 | OPTIMAX 眼睛专科中心',
                'short_title' => '青光眼',
                'summary' => '青光眼是一种视神经受损，进而造成视力逐渐丧失的眼疾。',
                'hero_image' => 'static/image/hero29.jpg',
                'thumbnail' => 'static/picture/glaucoma1.jpg',
                'brochure_pdf' => 'static/file/optiheal_CN.pdf',
                'intro_title' => '马来西亚<strong>青光眼</strong>专科',
                'intro_description' => '青光眼是一种视神经（连接眼睛与大脑的神经）受损，进而造成视力逐渐丧失的眼疾。在初期，青光眼并不会出现症状。患有青光眼的患者不会感到任何疼痛，因为眼睛内部的疾病进程缓慢，青光眼患者可能是在不知情的情况下逐渐失去视力。',
                'benefits_title' => '图：健康眼睛的视神经（左）青光眼的视神经（右）',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        ServiceSection::query()->updateOrCreate(
            ['service_id' => $glaucoma->id, 'type' => 'intro_image'],
            [
                'image' => 'static/picture/glaucoma.jpg',
                'sort_order' => 0,
                'is_active' => true,
            ],
        );

        $section = ServiceSection::query()->updateOrCreate(
            ['service_id' => $glaucoma->id, 'type' => 'two_column'],
            [
                'title' => '<strong>青光眼</strong>的病因',
                'description' => "青光眼是一种因视神经受损而导致视力逐渐丧失的眼睛疾病。其可分为：\n- 开角型青光眼\n- 闭角型青光眼\n## <strong>主因</strong>\n因各种因素导致内眼压升高。\n# 体征和症状\n<strong>开角型青光眼<br></strong>无症状\n<strong>闭角型青光眼<br></strong>会出现恶心，眼睛泛红及疼痛，虹视 - 彩虹样的光圈绕在灯光周围\n[button]static/file/optiheal_CN.pdf",
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        ServiceSectionItem::query()->updateOrCreate(
            ['service_section_id' => $section->id, 'title' => '<strong>青光眼</strong>治疗'],
            [
                'description' => "青光眼可使用眼药水或手术进行治疗。青光眼的治疗旨在控制病情，同时尽量减少病情在未来对视神经所带来伤害。早期诊断疾病非常重要，因眼睛一旦出现任何受损都是无法逆转的。\n- 各种眼药水\n- 激光治疗\n- 微创青光眼手术",
                'image' => 'static/picture/family2.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        $this->updateMenuUrls();
    }

    private function updateMenuUrls(): void
    {
        $header = Menu::query()->where('location', 'header')->first();

        if (! $header) {
            return;
        }

        $items = [
            '眼睛疾病' => 'eye-diseases-management.html',
            '青光眼' => 'glaucoma.html',
            '干眼症' => 'dry-eyes.html',
            '结膜炎' => 'conjunctivitis.html',
            '糖尿病性视网膜病变' => 'diabetic-retinopathy.html',
            '老年性黄斑部病变' => 'aged-related-macular-degeneration.html',
            '视网膜脱落' => 'retinal-detachment.html',
            '翼状胬肉' => 'pterygium.html',
            '圆锥角膜' => 'keratoconus.html',
            '眼睑疾病' => 'ptosis-surgery.html',
        ];

        foreach ($items as $title => $url) {
            $header->items()->where('title', $title)->update(['url' => $url]);
        }
    }
}
