<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Banner;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeContentAssetsSeeder extends Seeder
{
    public function run(): void
    {
        $home = Page::query()->where('slug', '/')->first();

        if (! $home) {
            return;
        }

        $this->seedBanners();
        $this->seedFeatureIcons($home);
        $this->seedSectionDefaults($home);
        $this->seedAwards();
        $this->seedPartners();
    }

    private function seedBanners(): void
    {
        $items = [
            ['31st Anniversary Optimax Eyes Specialist', 'static/picture/31anni@2x.webp', 'about.html'],
            ['Healthcare Asia Awards 2025', 'static/picture/asiahealth@2x.webp', 'about.html'],
            ['Smile Pro 2.0', 'static/picture/smilepro2@2x.webp', 'https://wa.me/60109091201?text=Hi%2C%20I%20would%20like%20to%20know%20more%20about%20Zeiss%20Smile%20Pro.'],
            ['OptiKIDZ', 'static/picture/optikidz-2411a@2x.webp', 'ttdi.html'],
            ['OptiKIDZ 2', 'static/picture/optikidz-2411b@2x.webp', 'ttdi.html'],
            ['Myopia App', 'static/picture/myopia-app@2x.webp', 'app.html'],
            ['Most Refractive Eye Treatments Provided in Malaysia', 'static/picture/mrec24@2x.webp', 'about.html'],
            ['Malaysia Healthcare', 'static/picture/expm@2x.webp', 'https://www.mhtc.org.my/'],
            ['Optimax Tele Consult', 'static/picture/tele3@2x.jpg', 'tel:60378902621'],
        ];

        foreach ($items as [$title, $image, $url]) {
            Banner::query()->updateOrCreate(
                ['title' => $title],
                [
                    'image' => $this->copyBannerImage($image),
                    'link_url' => $url,
                ],
            );
        }
    }

    private function copyBannerImage(string $image): string
    {
        $source = public_path($image);

        if (! is_file($source)) {
            return $image;
        }

        $target = 'banners/' . basename($image);

        if (! Storage::disk('public')->exists($target)) {
            Storage::disk('public')->put($target, file_get_contents($source));
        }

        return $target;
    }

    private function seedFeatureIcons(Page $home): void
    {
        $section = PageSection::query()->where('page_id', $home->id)->where('type', 'feature_grid')->first();

        if (! $section) {
            return;
        }

        $icons = [
            'static/picture/ico1.png',
            'static/picture/ico2.png',
            'static/picture/ico3.png',
            'static/picture/ico5.png',
            'static/picture/ico7.png',
            'static/picture/ico8.png',
            'static/picture/ico9.png',
            'static/picture/ico10.png',
        ];

        foreach ($icons as $index => $icon) {
            $item = $section->items()->where('sort_order', $index)->first();

            if ($item) {
                $item->forceFill(['icon' => $this->copySectionIcon($icon), 'is_active' => true])->save();
                continue;
            }

            $section->items()->create([
                'title' => 'Feature ' . ($index + 1),
                'icon' => $this->copySectionIcon($icon),
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }

    private function copySectionIcon(string $icon): string
    {
        $source = public_path($icon);

        if (! is_file($source)) {
            return $icon;
        }

        $target = 'section-icons/' . basename($icon);

        if (! Storage::disk('public')->exists($target)) {
            Storage::disk('public')->put($target, file_get_contents($source));
        }

        return $target;
    }

    private function seedSectionDefaults(Page $home): void
    {
        $defaults = [
            'intro_text_image' => ['button_text' => '我们的故事', 'button_url' => 'about.html'],
            'treatment_highlight' => ['button_text' => '更多信息', 'button_url' => 'no-blade-cataract-surgery.html'],
            'payment_plan' => ['button_text' => '更多信息', 'button_url' => 'lasik-pricing.html'],
            'logo_grid' => ['description' => '*可使用在指定分行'],
        ];

        foreach ($defaults as $type => $values) {
            $section = PageSection::query()->where('page_id', $home->id)->where('type', $type)->first();

            if (! $section) {
                continue;
            }

            foreach ($values as $column => $value) {
                if (blank($section->{$column})) {
                    $section->{$column} = $value;
                }
            }

            $section->save();
        }
    }

    private function seedAwards(): void
    {
        $items = [
            ['Specialty Hospital of The Year (Ophthalmology) - Malaysia', '2025', 'static/picture/awards-asiahealth.webp'],
            ['Ophthalmology Medical Centre of the Year in Asia-Pacific', '2022-2024', 'static/picture/gha22-24.webp'],
            ['Best Myopia Control Centre for Children', null, 'static/picture/parenthood.png'],
            ['Most Refractive Eye Treatments Provided in Malaysia', null, 'static/picture/tmbor.webp'],
            ['Malaysia Health & Wellness Brand Awards', '2022', 'static/picture/awards22.png'],
            ['Frost and Sullivan Best Lasik Centre Award', null, 'static/picture/award6.gif'],
            ['MRCA Crown Award - Outstanding National Growth Award', '2016', 'static/picture/award7.webp'],
            ['Sin Chew Business Excellence Awards', '2014-2015', 'static/picture/award4.gif'],
            ['BabyTalk Reader Choice and paediatric eye care recognition', null, 'static/picture/babytalk.webp'],
            ['The SMEs Best Brand Award - The Brand Laureate', null, 'static/picture/award5.gif'],
            ['Golden Bull Award', '2005', 'static/picture/award3.gif'],
            ['Golden Bull Award', '2003', 'static/picture/award2.webp'],
            ['5 Years of Successful Surgeries Certification by Carl Zeiss', null, 'static/picture/zeiss.png'],
        ];

        foreach ($items as $index => [$title, $year, $image]) {
            Award::query()->updateOrCreate(
                ['title' => $title, 'year' => $year],
                [
                    'image' => $this->copyAwardImage($image),
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }
    }

    private function copyAwardImage(string $image): string
    {
        $source = public_path($image);

        if (! is_file($source)) {
            return $image;
        }

        $target = 'awards/' . basename($image);

        if (! Storage::disk('public')->exists($target)) {
            Storage::disk('public')->put($target, file_get_contents($source));
        }

        return $target;
    }

    private function seedPartners(): void
    {
        $items = [
            ['Prudential', 'static/picture/logo-pru.webp'],
            ['Allianz', 'static/picture/logo-allianz.png'],
            ['Asia Assistance', 'static/picture/logo-aa.png'],
            ['Emergency Assistance Japan', 'static/picture/logo-eaj.webp'],
            ['Health Metric', 'static/picture/logo-hm.png'],
            ['International Assistance', 'static/picture/logo-ia.webp'],
            ['Integrated Healthcare Management', 'static/picture/logo-ihm.png'],
            ['MiCare', 'static/picture/logo-micare.webp'],
            ['MIYA', 'static/picture/logo-miya.png'],
            ['PM Care', 'static/picture/logo-pmcare.png'],
            ['Medkad', 'static/picture/medkad.webp'],
            ['Compumed', 'static/picture/compumed.webp'],
        ];

        foreach ($items as $index => [$name, $logo]) {
            Partner::query()->updateOrCreate(
                ['name' => $name],
                [
                    'type' => 'insurance',
                    'logo' => $this->copyPartnerLogo($logo),
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }
    }

    private function copyPartnerLogo(string $logo): string
    {
        $source = public_path($logo);

        if (! is_file($source)) {
            return $logo;
        }

        $target = 'partners/' . basename($logo);

        if (! Storage::disk('public')->exists($target)) {
            Storage::disk('public')->put($target, file_get_contents($source));
        }

        return $target;
    }
}
