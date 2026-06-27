<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\ContactForm;
use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class ContentStructureSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'RXZX 眼睛专科中心',
                'hotline' => '1800 88 1201',
                'whatsapp_number' => '',
                'whatsapp_url' => '#',
                'facebook_url' => '#',
                'instagram_url' => '#',
                'english_button_enabled' => true,
                'english_button_url' => '#',
                'footer_license_text' => 'KKLIU 3517 | Tarikh Tamat Tempoh: 31 Disember 2026',
                'copyright_text' => '© RXZX 眼睛专科中心',
            ],
        );

        $pages = [
            ['title' => '主页', 'slug' => '/', 'template' => 'home'],
            ['title' => '关于我们', 'slug' => 'about', 'template' => 'standard'],
            ['title' => '首席执行员个人履历', 'slug' => 'ceo', 'template' => 'standard'],
            ['title' => '我们的专科医生', 'slug' => 'doctors', 'template' => 'doctor_list'],
            ['title' => '为何选择我们', 'slug' => 'why-choose-us', 'template' => 'standard'],
            ['title' => '白内障治疗', 'slug' => 'cataract', 'template' => 'standard'],
            ['title' => '眼睛疾病', 'slug' => 'eye-diseases-management', 'template' => 'standard'],
            ['title' => '激光矫视', 'slug' => 'laser-vision-correction', 'template' => 'standard'],
            ['title' => '儿童', 'slug' => 'kids', 'template' => 'standard'],
            ['title' => '整形外科', 'slug' => 'plastic-surgery', 'template' => 'standard'],
            ['title' => '联系我们', 'slug' => 'contact', 'template' => 'contact'],
            ['title' => '条款及细则', 'slug' => 'terms', 'template' => 'standard'],
            ['title' => '隐私政策', 'slug' => 'privacy', 'template' => 'standard'],
        ];

        foreach ($pages as $index => $page) {
            Page::query()->updateOrCreate(
                ['slug' => $page['slug']],
                [
                    ...$page,
                    'hero_title' => $page['title'],
                    'breadcrumb_title' => $page['title'],
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }

        $categories = [
            ['title' => '白内障治疗', 'slug' => 'cataract', 'type' => 'cataract'],
            ['title' => '眼睛疾病', 'slug' => 'eye-diseases', 'type' => 'disease'],
            ['title' => '激光矫视', 'slug' => 'laser-vision-correction', 'type' => 'laser'],
            ['title' => '儿童眼科', 'slug' => 'kids', 'type' => 'kids'],
            ['title' => '整形外科', 'slug' => 'plastic-surgery', 'type' => 'plastic'],
            ['title' => '其他治疗', 'slug' => 'other', 'type' => 'other'],
        ];

        foreach ($categories as $index => $category) {
            ServiceCategory::query()->updateOrCreate(
                ['slug' => $category['slug']],
                [...$category, 'sort_order' => $index, 'is_active' => true],
            );
        }

        $services = [
            ['白内障治疗', '无刀飞秒激光白内障手术（FLACS）', 'no-blade-cataract-surgery', true],
            ['白内障治疗', '屈光性晶状体置换术（RLE）', 'refractive-lens-exchange', false],
            ['眼睛疾病', '青光眼', 'glaucoma', false],
            ['眼睛疾病', '糖尿病性视网膜病变', 'diabetic-retinopathy', false],
            ['眼睛疾病', '结膜炎', 'conjunctivitis', false],
            ['眼睛疾病', '干眼症', 'dry-eyes', false],
            ['眼睛疾病', '翼状胬肉', 'pterygium', false],
            ['眼睛疾病', '老年性黄斑部病变', 'aged-related-macular-degeneration', false],
            ['眼睛疾病', '视网膜脱落', 'retinal-detachment', false],
            ['眼睛疾病', '圆锥角膜', 'keratoconus', false],
            ['眼睛疾病', '眼睑疾病', 'ptosis-surgery', false],
            ['眼睛疾病', '眼睛检查', 'eye-examinations', false],
            ['眼睛疾病', '企业眼科检查', 'eye-screening', false],
            ['激光矫视', 'ZEISS SMILE Pro', 'zeiss-smile-pro', false],
            ['激光矫视', 'Presbyond 视觉融合激光', 'presbyond', false],
            ['激光矫视', '全飞秒激光', 'relex-smile', false],
            ['激光矫视', 'CLEAR Max', 'clearmax', false],
            ['激光矫视', '飞秒激光矫视', 'femto-lasik', false],
            ['激光矫视', '激光角膜表层切削术（ASA）', 'advanced-surface-ablation', false],
            ['激光矫视', '量身定制的 TESA', 'tesa-s', false],
            ['其他治疗', '可植入式隐形眼镜（ICL）', 'implantable-collamer-lens', false],
            ['其他治疗', '硬性透氧性隐形眼镜（RGP）', 'rigid-gas-permeable-lenses', false],
            ['儿童眼科', '儿童近视控制', 'kids-myopia', false],
            ['儿童眼科', '弱视（懒惰眼）', 'amblyopia', false],
            ['儿童眼科', '儿童斜视', 'strabismus', false],
            ['儿童眼科', '儿童眼睛检查', 'eye-examinations-kids', false],
            ['儿童眼科', '角膜塑形术', 'ortho-k', false],
            ['儿童眼科', '视觉矫正师', 'orthoptist', false],
        ];

        foreach ($services as $index => [$categoryTitle, $title, $slug, $isFeatured]) {
            $category = ServiceCategory::query()->where('title', $categoryTitle)->first();

            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category?->id,
                    'title' => $title,
                    'short_title' => $title,
                    'summary' => '后台可编辑此项目简介。',
                    'intro_title' => $title,
                    'intro_description' => '后台可编辑治疗介绍、优势、流程及常见问题。',
                    'benefits_title' => '治疗优势',
                    'is_featured' => $isFeatured,
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }

        $home = Page::query()->where('slug', '/')->first();

        if ($home) {
            $sections = [
                ['intro_text_image', '30年 的实战专业经验', '我们是屡获殊荣的眼科专家中心。'],
                ['feature_grid', '为什么选择我们', ''],
                ['treatment_highlight', '最新来自 RXZX', '无刀飞秒激光白内障手术（FLACS）'],
                ['payment_plan', '0% 轻松付款', '提供灵活付款方式。'],
                ['award_grid', '我们的奖项', ''],
                ['logo_grid', '保险 & TPA', ''],
            ];

            foreach ($sections as $index => [$type, $title, $description]) {
                PageSection::query()->updateOrCreate(
                    ['page_id' => $home->id, 'type' => $type],
                    [
                        'title' => $title,
                        'description' => $description,
                        'sort_order' => $index,
                        'is_active' => true,
                    ],
                );
            }

            $featureSection = PageSection::query()
                ->where('page_id', $home->id)
                ->where('type', 'feature_grid')
                ->first();

            foreach ([
                '医生具专业资格及经验丰富',
                '于马来西亚首推全飞秒激光矫视',
                '拥有强大支援系统及关系网',
                '一站式多元专业治疗',
                '私营眼睛专科服务经验',
                'ISO 认证',
                '治疗结果和分析系统',
                '屡获殊荣的眼睛专科',
            ] as $index => $title) {
                $featureSection?->items()->updateOrCreate(
                    ['title' => $title],
                    ['sort_order' => $index, 'is_active' => true],
                );
            }
        }

        foreach ([
            ['Specialty Hospital of The Year (Ophthalmology) - Malaysia', '2025'],
            ['Ophthalmology Medical Centre of the Year in Asia-Pacific', '2022-2024'],
            ['Best Myopia Control Centre for Children', null],
            ['Most Refractive Eye Treatments Provided in Malaysia', null],
            ['Malaysia Health & Wellness Brand Awards', '2022'],
            ['Frost and Sullivan Best Lasik Centre Award', null],
            ['MRCA Crown Award - Outstanding National Growth Award', '2016'],
            ['Sin Chew Business Excellence Awards', '2014-2015'],
            ['Golden Bull Award', '2005'],
            ['Golden Bull Award', '2003'],
        ] as $index => [$title, $year]) {
            Award::query()->updateOrCreate(
                ['title' => $title, 'year' => $year],
                ['sort_order' => $index, 'is_active' => true],
            );
        }

        foreach ([
            'Prudential',
            'Allianz',
            'Asia Assistance',
            'Emergency Assistance Japan',
            'Health Metric',
            'International Assistance',
            'Integrated Healthcare Management',
            'MiCare',
            'MIYA',
            'PM Care',
            'Compumed',
        ] as $index => $name) {
            Partner::query()->updateOrCreate(
                ['name' => $name],
                ['type' => 'insurance', 'sort_order' => $index, 'is_active' => true],
            );
        }

        $contactForm = ContactForm::query()->updateOrCreate(
            ['name' => '查询及预约表格'],
            ['is_active' => true],
        );

        foreach ([
            ['姓名', 'name', 'text', true],
            ['电话', 'phone', 'phone', true],
            ['邮箱', 'email', 'email', false],
            ['感兴趣的服务', 'service', 'select', false],
            ['留言', 'message', 'textarea', false],
        ] as $index => [$label, $name, $type, $required]) {
            $contactForm->fields()->updateOrCreate(
                ['name' => $name],
                [
                    'label' => $label,
                    'type' => $type,
                    'is_required' => $required,
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }

        $this->seedMenus();
    }

    private function seedMenus(): void
    {
        $header = Menu::query()->updateOrCreate(
            ['location' => 'header'],
            ['name' => '顶部导航', 'is_active' => true],
        );

        $footer = Menu::query()->updateOrCreate(
            ['location' => 'footer'],
            ['name' => '页脚导航', 'is_active' => true],
        );

        $headerItems = [
            ['主页', '/', []],
            ['关于我们', '/about', [
                ['我们的故事', '/about'],
                ['首席执行员个人履历', '/ceo'],
                ['我们的专科医生', '/doctors'],
                ['为何选择我们', '/why-choose-us'],
            ]],
            ['白内障治疗', '/cataract', [
                ['无刀飞秒激光白内障手术（FLACS）', '/no-blade-cataract-surgery'],
                ['屈光性晶状体置换术（RLE）', '/refractive-lens-exchange'],
            ]],
            ['眼睛疾病', '/eye-diseases-management', [
                ['青光眼', '/glaucoma'],
                ['糖尿病性视网膜病变', '/diabetic-retinopathy'],
                ['结膜炎', '/conjunctivitis'],
                ['干眼症', '/dry-eyes'],
                ['翼状胬肉', '/pterygium'],
                ['老年性黄斑部病变', '/aged-related-macular-degeneration'],
                ['视网膜脱落', '/retinal-detachment'],
                ['圆锥角膜', '/keratoconus'],
                ['眼睑疾病', '/ptosis-surgery'],
                ['眼睛检查', '/eye-examinations'],
                ['企业眼科检查', '/eye-screening'],
            ]],
            ['激光矫视', '/laser-vision-correction', [
                ['ZEISS SMILE Pro', '/zeiss-smile-pro'],
                ['Presbyond 视觉融合激光', '/presbyond'],
                ['全飞秒激光', '/relex-smile'],
                ['CLEAR Max', '/clearmax'],
                ['飞秒激光矫视', '/femto-lasik'],
                ['激光角膜表层切削术（ASA）', '/advanced-surface-ablation'],
                ['量身定制的 TESA', '/tesa-s'],
                ['可植入式隐形眼镜（ICL）', '/implantable-collamer-lens'],
                ['硬性透氧性隐形眼镜（RGP）', '/rigid-gas-permeable-lenses'],
            ]],
            ['儿童', '/kids', [
                ['儿童近视控制', '/kids-myopia'],
                ['弱视（懒惰眼）', '/amblyopia'],
                ['儿童斜视', '/strabismus'],
                ['儿童眼睛检查', '/eye-examinations-kids'],
                ['角膜塑形术', '/ortho-k'],
                ['视觉矫正师', '/orthoptist'],
            ]],
            ['整形外科', '/plastic-surgery', []],
            ['联系我们', '/contact', [
                ['查询及预约表格', '/contact'],
            ]],
        ];

        $this->syncMenuItems($header, $headerItems);

        $footerItems = [
            ['主页', '/', []],
            ['关于我们', '/about', []],
            ['激光矫视', '/laser-vision-correction', []],
            ['其他治疗', '/implantable-collamer-lens', []],
            ['白内障治疗', '/cataract', []],
            ['儿童', '/kids', []],
            ['整形外科', '/plastic-surgery', []],
            ['眼睛疾病', '/eye-diseases-management', []],
            ['联系我们', '/contact', []],
            ['条款及细则', '/terms', []],
            ['隐私政策', '/privacy', []],
        ];

        $this->syncMenuItems($footer, $footerItems);
    }

    private function syncMenuItems(Menu $menu, array $items): void
    {
        foreach ($items as $index => [$title, $url, $children]) {
            $item = $menu->items()->updateOrCreate(
                ['parent_id' => null, 'title' => $title],
                [
                    'url' => $url,
                    'target' => '_self',
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );

            foreach ($children as $childIndex => [$childTitle, $childUrl]) {
                $menu->items()->updateOrCreate(
                    ['parent_id' => $item->id, 'title' => $childTitle],
                    [
                        'url' => $childUrl,
                        'target' => '_self',
                        'sort_order' => $childIndex,
                        'is_active' => true,
                    ],
                );
            }
        }
    }
}
