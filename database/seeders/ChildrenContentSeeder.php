<?php

namespace Database\Seeders;

use App\Models\ContactCta;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class ChildrenContentSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::query()->updateOrCreate(
            ['slug' => 'kids'],
            [
                'title' => '儿童',
                'type' => 'children',
                'hero_title' => '<strong>儿童</strong>',
                'hero_image' => 'static/image/hero20.jpg',
                'intro_title' => '儿童<strong>视力及眼睛保健</strong>',
                'intro_description' => '孩子的身体，认知及社交的发展在很大程度是取决于他们的视力。未获得正确矫正视力问题将会对孩子的身心发展带来损害，这也会对他们的学习能力构成干扰。童年时期的视力障碍将会影响他们进入成年岁月的生活健康及美好，这也可能会导致永久性视力丧失。给予孩子眼睛应有的关注，以保障他们未来人生的美好！',
                'description' => '儿童视力及眼睛保健',
                'sort_order' => 40,
                'is_active' => true,
            ],
        );

        ContactCta::query()->updateOrCreate(
            ['key' => 'children'],
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

        $children = [
            ['儿童近视控制', 'kids-myopia', 'static/picture/kids-myopia0.jpg', 1],
            ['弱视 (懒惰眼)', 'amblyopia', 'static/picture/kids-amblyopia.jpg', 2],
            ['斜视', 'strabismus', 'static/picture/kids-squint.jpg', 3],
            ['眼睛检查', 'eye-examinations-kids', 'static/picture/kids-exam.jpg', 4],
            ['角膜塑形术 (Ortho-K)', 'ortho-k', 'static/picture/kids-orthok.jpg', 5],
            ['视觉矫正师', 'orthoptist', 'static/picture/orthoptist.jpg', 6],
        ];

        foreach ($children as [$title, $slug, $thumbnail, $sortOrder]) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $title,
                    'short_title' => $title,
                    'summary' => $title,
                    'hero_image' => 'static/image/hero21.jpg',
                    'thumbnail' => $thumbnail,
                    'intro_title' => '儿童<strong>' . $title . '</strong>',
                    'intro_description' => '相关详情内容可在后台「儿童 → 儿童管理」中补充维护。',
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ],
            );
        }

        $strabismus = Service::query()->updateOrCreate(
            ['slug' => 'strabismus'],
            [
                'category_id' => $category->id,
                'title' => '儿童斜视',
                'short_title' => '儿童斜视',
                'summary' => '斜视也称为眼睛错位或斜眼，这是一种双眼视线不一致，意指眼睛不对齐。',
                'hero_image' => 'static/image/hero21.jpg',
                'thumbnail' => 'static/picture/kids-squint.jpg',
                'intro_title' => '儿童<strong>斜视</strong>',
                'intro_description' => '斜视也称为眼睛错位或斜眼，这是一种双眼视线不一致，意指眼睛不对齐。眼睛错位可能是向内（会聚性斜视）或向外（散开性斜视）。一只眼睛可比另外一只眼睛高。斜视或可能会导致复视，这会迫使大脑抑制较弱的眼睛，从而导致患上弱视或懒惰眼。',
                'sort_order' => 3,
                'is_active' => true,
            ],
        );

        ServiceSection::query()->where('service_id', $strabismus->id)->delete();

        ServiceSection::query()->create([
            'service_id' => $strabismus->id,
            'type' => 'image_right',
            'title' => '<strong>斜视</strong>结果',
            'description' => "斜视可能会是持续性及一直存在，或者也可能是间歇性并在某种情况下才会发生，例如当孩子正在读书，疲倦或向远处凝视的时候。其会导致：\n- 外观问题\n- 复视\n- 弱视（懒惰眼）\n- 缺乏深度感知",
            'image' => 'static/image/kids-squint2.jpg',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        ServiceSection::query()->create([
            'service_id' => $strabismus->id,
            'type' => 'image_left_blue',
            'title' => '<strong>斜视</strong>治疗',
            'description' => "斜视的治疗方法是取决于斜视发生的时间，类型和其严重程度。在治疗儿童的个案中，斜视治疗可增进他们的视觉和双眼视力。儿童斜视的治疗方法包括：\n- 眼镜\n- 眼罩治疗\n- 眼部运动\n- 棱镜\n- 眼肌手术",
            'image' => 'static/image/kids-squint3.jpg',
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }
}
