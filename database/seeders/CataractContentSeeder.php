<?php

namespace Database\Seeders;

use App\Models\ContactCta;
use App\Models\ContactForm;
use App\Models\Menu;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSection;
use App\Models\ServiceSectionItem;
use Illuminate\Database\Seeder;

class CataractContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->updateOrCreate(
            ['slug' => 'cataract'],
            [
                'title' => '马来西亚白内障专家',
                'type' => 'cataract',
                'hero_title' => '<strong>白内障</strong>治疗',
                'hero_image' => 'service-categories/hero10.jpg',
                'intro_title' => '马来西亚白内障专家',
                'intro_description' => '随着年龄的增长，眼内透明的天然晶状体会变得浑浊。 这种情况被称为白内障，常见于老年人。 镜片混浊会阻止足够的光线进入眼睛，并导致视力模糊。',
                'symptom_title' => '白内障的症状',
                'symptom_description' => '轻度白内障可能不会影响视力的清晰度，但是随着年龄的增长，它可能导致：',
                'symptom_image' => 'service-categories/cataract1.jpg',
                'symptoms' => "视力模糊\n对光敏感\n一只眼睛的双重视野\n泛黄或褪色\n阅读困难\n夜视力差\n眩光和光环",
                'description' => '随着年龄的增长，眼内透明的天然晶状体会变得浑浊。',
                'sort_order' => 10,
                'is_active' => true,
            ],
        );

        ContactCta::query()->updateOrCreate(
            ['key' => 'cataract'],
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

        ContactCta::query()->updateOrCreate(
            ['key' => 'treatment_registration'],
            [
                'subtitle' => '立即注册以进行初步眼睛检查!',
                'title' => '今天立即联络我们',
                'description' => '无论您仅是需要简单的眼睛健康检查，或者想要进行复杂的眼科手术，请安心与我们预约。我们的眼科医生和验光师团队，将竭尽所能满足您对眼睛保健及护理的所有需求。今天即联系我们，我们随时为您提供帮助！',
                'extra_text' => '请在下面填写您的详细信息，我们将尽快与您联系。 您也可以直接拨打免费电话 1800 88 1201与我们联系。',
                'note' => '条款和条件适用.',
                'background_image' => 'contact/cta2021.jpg',
                'show_form' => true,
                'is_active' => true,
            ],
        );

        ContactForm::query()->updateOrCreate(
            ['key' => 'treatment_registration'],
            [
                'name' => '今天立即联络我们',
                'is_active' => true,
            ],
        );

        $flacs = Service::query()->updateOrCreate(
            ['slug' => 'no-blade-cataract-surgery'],
            [
                'category_id' => $category->id,
                'title' => '无刀飞秒激光白内障手术 (FLACS) | OPTIMAX 眼睛专科中心',
                'short_title' => '无刀飞秒激光白内障手术',
                'summary' => '无刀白内障手术，亦被称为无刀飞秒激光白内障手术（FLACS）是采用飞秒激光以帮助摘除白内障。',
                'hero_image' => 'services/hero26.jpg',
                'thumbnail' => 'services/cataract-no-blade.jpg',
                'intro_title' => '无刀飞秒激光白内障手术 (FLACS)',
                'intro_description' => '白内障是基于晶状体蛋白质变性而发生混浊，这会导致视力变得模糊。无刀白内障手术，亦被称为无刀飞秒激光白内障手术（FLACS）是采用飞秒激光（激光脉冲）以帮助摘除白内障。这项革新高端技术促使白内障手术可带来更高的精确度、安全性和效果。',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        $rle = Service::query()->updateOrCreate(
            ['slug' => 'refractive-lens-exchange'],
            [
                'category_id' => $category->id,
                'title' => '屈光性晶状体置换术 (RLE) | Refractive Surgery | OPTIMAX Malaysia',
                'short_title' => '屈光性晶状体置换术 (RLE)',
                'summary' => '屈光性晶状体置换术是一种外科手术，有关手术程序是将天然水晶体摘除，并以透明的人工水晶体替换。',
                'hero_image' => 'services/hero26.jpg',
                'thumbnail' => 'services/cataract-rle.jpg',
                'intro_title' => '屈光性晶状体置换术 (RLE)',
                'intro_description' => '屈光性晶状体置换术是一种外科手术，有关手术程序是将天然水晶体摘除，并以透明的人工水晶体替换。这种透明的人工水晶体也称为人工晶状体（IOL），其可帮助矫正眼睛的焦光度，这意味着您无需再依赖眼镜或隐形眼镜的辅助，即可看到清晰影像，重获视力。',
                'sort_order' => 2,
                'is_active' => true,
            ],
        );

        $this->section($flacs, 'intro_image', null, null, '图。 激光白内障机器', 'services/cataract-machine.png', 0);
        $steps = $this->section($flacs, 'steps', '无刀飞秒激光白内障手术相较传统常规手术', null, null, null, 1);
        $this->items($steps, [
            ['步骤一', "无刀飞秒激光白内障手术：运用精准，细小及准确中心定位的飞秒激光技术，在患者眼内进行切口操作。\n传统常规手术：运用手术刀或金刚石刀片在眼睛上进行切口操作。", 'services/pro-noblade1.jpg'],
            ['步骤二', "无刀飞秒激光白内障手术：运用激光在晶状体囊做出精确及完美圆形的居中自封闭切口。\n传统常规手术：使用金属挂钩或镊子以手动方式打开晶状体囊。", 'services/pro-noblade2.jpg'],
            ['步骤三', "无刀飞秒激光白内障手术：激光可在几秒钟内将白内障软化并分解成更小部分。\n传统常规手术：使用超声波将混浊的晶体粉碎。", 'services/pro-noblade3.jpg'],
            ['步骤四', "通过抽吸及冲洗方式去除白内障。后使用植入器植入人工水晶体。", 'services/pro-noblade4.jpg'],
        ]);
        $blue = $this->section($flacs, 'blue_columns', null, null, null, null, 2);
        $this->items($blue, [
            ['无刀飞秒激光白内障手术优点', "微创手术\n效果可预测\n量身定制\n手术精度和安全性更高\n具有更好的疗效及成果", null, null],
            ['备用多种优质人工水晶体的选择:', "单焦点镜片 - 仅矫正远视和散光（散光镜片）\n双焦点镜片 - 矫正远视、近视和散光（散光镜片）\n三焦点/多焦点镜片 - 矫正远视、中视、近视和散光（散光镜片）", null, 'static/file/optilife_CN.pdf'],
        ]);

        $this->section($rle, 'intro_image', null, null, null, 'services/rle1.png', 0);
        $iol = $this->section($rle, 'iol', '人工水晶体', '图：人工水晶体 (IOL)', "我们提供多元选择的人工水晶体。我们专业的眼科医生将会为您提供咨询，帮助您选择最适合且为您带来最大效益的人工水晶体。\n\n单焦点\n多焦点\n单焦点复曲面透镜\n多焦点复曲面透镜\n\n屈光性晶状体置换术的操作程序需时多久？ 是否安全呢？\n由我们富有经验的眼科医生进行屈光性晶状体置换术的程序仅需不超过30分钟的时间。一次屈光性晶状体置换术通常先于一只眼睛进行。\n屈光性晶状体置换术是当今世界最常见的眼科手术，每年大约有150万人进行屈光性晶状体置换术。其乃治疗白内障唯一安全及可靠的治疗方法。", 'services/rle2.jpg', 1);
        $procedure = $this->section($rle, 'procedure', '屈光性晶状体置换术程序', null, null, null, 2);
        $this->items($procedure, [
            ['步骤一', '在角膜上边缘做一个3mm的微小切口，后使用超声波透过微小切口软化并去除天然晶状体。', 'services/pro-rle1.png'],
            ['步骤二', '在完全取出天然晶状体后，人工晶状体将被植入眼内，以帮助恢复视力。基于切口微小，在无需缝线的状况下切口即可密封。', 'services/pro-rle2.png'],
            ['步骤三', '欢迎拥有您的全新视野，崭新人生。', 'services/pro-rle3.png'],
        ]);
        $rleBlue = $this->section($rle, 'blue_columns', null, null, null, null, 3);
        $this->items($rleBlue, [
            ['优点', "恢复远距离视力\n保留阅读能力（使用多焦点人工晶状体）\n未来无需再进行白内障手术\n快速恢复视力\n效果可预测", null, null],
            ['适合人选：', "想要减少甚至摆脱他们对眼镜的依赖\n不适合进行飞秒全激光矫视手术或植入式隐形眼镜手术者\n超过18岁，并持续有屈光不正（视力）问题\n出现与年龄相关的阅读困难\n身体健康良好", null, 'static/file/optilife_CN.pdf'],
        ]);

        Menu::query()->where('location', 'header')->get()->each(function (Menu $menu): void {
            $menu->items()->where('title', '白内障治疗')->update(['url' => 'cataract.html']);
            $menu->items()->where('title', '无刀飞秒激光白内障手术（FLACS）')->update(['url' => 'no-blade-cataract-surgery.html']);
            $menu->items()->where('title', '屈光性晶状体置换术 (RLE)')->update(['url' => 'refractive-lens-exchange.html']);
        });
    }

    private function section(Service $service, string $type, ?string $title, ?string $subtitle, ?string $description, ?string $image, int $sort): ServiceSection
    {
        return ServiceSection::query()->updateOrCreate(
            ['service_id' => $service->id, 'type' => $type],
            [
                'title' => $title,
                'subtitle' => $subtitle,
                'description' => $description,
                'image' => $image,
                'sort_order' => $sort,
                'is_active' => true,
            ],
        );
    }

    private function items(ServiceSection $section, array $items): void
    {
        foreach ($items as $index => $item) {
            [$title, $description, $image, $icon] = array_pad($item, 4, null);
            ServiceSectionItem::query()->updateOrCreate(
                ['service_section_id' => $section->id, 'title' => $title],
                [
                    'description' => $description,
                    'image' => $image,
                    'icon' => $icon,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
