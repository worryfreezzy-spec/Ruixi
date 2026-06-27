<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\BranchCity;
use App\Models\ContactForm;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => '联络 <strong>OPTIMAX</strong>',
                'template' => 'contact',
                'hero_title' => '保持联系',
                'hero_image' => 'static/image/hero18.jpg',
                'summary' => '无论您仅是需要简单的眼科检查，或者想要进行复杂的眼科手术，请安心与我们预约。我们拥有经验丰富及具有实战能力的眼科医生和验光师团队，将竭尽所能满足您对眼睛保健及护理的全方位需求。今天即联系我们，我们随时为您提供帮助！',
                'is_active' => true,
                'sort_order' => 90,
            ],
        );

        PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'contact_branches'],
            [
                'title' => 'OPTIMAX分行',
                'description' => '您可通过点击以下位置以获取临近OPTIMAX分行的联系详情，地点及营业时间：',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'type' => 'contact_form'],
            [
                'title' => '查询及预约表格',
                'subtitle' => '* 需填写所有栏目',
                'description' => '请在下方填写您的详细信息，我们将尽快与您联系。您也可以直接拨打免费电话 1800 88 1201 与我们取得联系。',
                'sort_order' => 2,
                'is_active' => true,
            ],
        );

        ContactForm::query()->updateOrCreate(
            ['key' => 'contact_page'],
            ['name' => '联系我们页面表单', 'is_active' => true],
        );

        $cities = [
            ['Central Region', 'central-region', 1],
            ['Northern Region', 'northern-region', 2],
            ['Southern Region', 'southern-region', 3],
            ['East Malaysia', 'east-malaysia', 4],
            ['Other Countries', 'other-countries', 5],
        ];

        foreach ($cities as [$name, $slug, $sortOrder]) {
            BranchCity::query()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'sort_order' => $sortOrder, 'is_active' => true],
            );
        }

        $cityIds = BranchCity::query()->pluck('id', 'slug');

        $branches = [
            ['central-region', 'Taman Tun Dr. Ismail, KL (HQ)', 'ttdi', 1],
            ['central-region', 'Sri Petaling', 'sri-petaling', 2],
            ['central-region', 'Cheras', 'cheras', 3],
            ['central-region', 'Kepong', 'kepong', 4],
            ['central-region', 'Melawati', 'melawati', 5],
            ['central-region', 'OUG', 'oug', 6],
            ['central-region', 'Damansara Jaya', 'damansara-jaya', 7],
            ['central-region', 'Bandar Sunway', 'sunway', 8],
            ['central-region', 'Elmina', 'elmina', 9],
            ['central-region', 'Kota Kemuning', 'kota-kemuning', 10],
            ['central-region', 'Shah Alam', 'shah-alam', 11],
            ['central-region', 'Klang', 'klang', 12],
            ['northern-region', 'Penang Eye Specialist Hospital', 'penang', 1],
            ['northern-region', 'Bukit Mertajam', 'bukit-mertajam', 2],
            ['northern-region', 'Ipoh', 'ipoh', 3],
            ['southern-region', 'Seremban', 'seremban', 1],
            ['southern-region', 'Bahau', 'bahau', 2],
            ['southern-region', 'Kluang', 'kluang', 3],
            ['southern-region', 'Muar', 'muar', 4],
            ['southern-region', 'Segamat', 'segamat', 5],
            ['southern-region', 'Johor Bahru', 'johor', 6],
            ['southern-region', 'Sutera, Johor Bahru', 'sutera', 7],
            ['east-malaysia', 'Kuching', 'kuching', 1],
            ['east-malaysia', 'Kota Kinabalu', 'kota-kinabalu', 2],
            ['other-countries', 'Cambodia', 'cambodia', 1],
        ];

        foreach ($branches as [$citySlug, $title, $slug, $sortOrder]) {
            Branch::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'city_id' => $cityIds[$citySlug],
                    'title' => $title,
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ],
            );
        }

        Branch::query()->updateOrCreate(
            ['slug' => 'johor'],
            [
                'city_id' => $cityIds['southern-region'],
                'title' => '新山',
                'address' => "53 & 55, Jalan Cantik 6,\nTaman Pelangi Indah,\n81800 Ulu Tiram, Johor.",
                'phone' => '+607-8590528',
                'whatsapp' => '+6019-714 2101',
                'email' => 'johor@optimax.com.my',
                'business_hours' => "周一至周六： 9.00am-6.00pm\n星期日: 休息",
                'contact_url' => 'tel:+607-8590528',
                'street_view_url' => 'https://goo.gl/maps/WcvMMbBE2nH2',
                'waze_url' => 'waze://?ll=1.577432,103.800594&navigate=yes',
                'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3058885578243!2d103.79859231475965!3d1.5776573612406077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da6ec25356e0e3%3A0x3619e6e2f7b373f7!2sOptimax+Eye+Specialist+Centre+(Johor)!5e0!3m2!1sen!2smy!4v1522949366224" frameborder="0" style="border: 0;" allowfullscreen></iframe>',
                'sort_order' => 4,
                'is_active' => true,
            ],
        );

        $contactItems = MenuItem::query()->where('title', '联系我们')->get();
        foreach ($contactItems as $item) {
            $item->update(['url' => 'contact.html']);
            $item->children()->update(['is_active' => false]);
        }
    }
}
