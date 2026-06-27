<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class DoctorContentSeeder extends Seeder
{
    public function run(): void
    {
        $about = Page::query()->where('slug', 'about')->first();

        $page = Page::query()->updateOrCreate(
            ['slug' => 'doctors'],
            [
                'parent_id' => $about?->id,
                'title' => '我们的专科医生 | OPTIMAX 眼睛专科中心',
                'template' => 'doctors',
                'hero_title' => '我们的专科医生',
                'breadcrumb_title' => '我们的专科医生',
                'summary' => '我们专业的眼科医生团队等待您的咨询，为您与您的灵魂之窗提供最专业的服务保障。',
                'is_active' => true,
                'sort_order' => 30,
            ],
        );

        $sections = [
            [
                'type' => 'doctors_hero',
                'title' => '我们的专科医生',
                'image' => 'about/hero8.jpg',
                'sort_order' => 0,
            ],
            [
                'type' => 'doctors_intro',
                'title' => '了解我们位于马来西亚Optimax的专科医生',
                'description' => '我们专业的眼科医生团队等待您的咨询，为您与您的灵魂之窗提供最专业的服务保障。',
                'sort_order' => 1,
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

        $doctors = [
            ['dr-stephen', 'DR STEPHEN CHUNG SOON HEE', 'dr-stephen2022.jpg', 'MBBS, MS (OPHTHAL)', 'TTDI'],
            ['dr-chuah', 'DR CHUAH KAY LEONG', 'dr-chuah2022.jpg', 'MB BAO BCh (UK), FRCOphth (London)', 'TTDI'],
            ['dr-lee', 'DR LEE SEOW YEANG', 'dr-lee2022.jpg', "MD (UKM), M SURG (OPHTH) (UKM), M.MED (OPHTH) S'PORE, FRCSEd", 'Penang'],
            ['dr-nor', 'DR NOR ZAINURA ZAINAL', 'dr-zainura2022.jpg', 'LRCP & SI, MBBCh. BAO (Ireland), MS (OPHTHAL) (UKM)', 'Shah Alam'],
            ['dr-ngo', 'DR NGO CHEK TUNG', 'dr-jason-ngo.webp', 'MBBS (Malaya), M.Med Ophth (NUS), MRCSEd, FRCOphth, CertLRS', 'Bandar Sunway'],
            ['dr-chang', 'DR CHANG KHAI MENG', 'dr-chang.webp', 'MD (USM), MMED (OPHTHALMOLOGY)', 'Sri Petaling'],
            ['dr-lam', 'DR LAM HEE HONG', 'dr-lam2022.jpg', 'MBBS (UM), ICO (Cambridge), Master of Surgery (UM)', 'Johor Bahru, Kluang'],
            ['dr-ngim', 'DR NGIM YOU SIANG', 'dr-ngim.jpg', 'MBBS (UM), M.S. OPHTHAL(UM)', 'Muar, Segamat'],
            ['dr-adeline', 'DR ADELINE SIA SIEN BING', 'dr-adeline2022.jpg', 'MBBS (UM), MOphth (UM)', 'TTDI', "眼科顾问医生\n屈光手术医生", "LASIK / 激光屈光治疗 (SMILE Pro, SMILE, FemtoLASIK, ASA, TESA, PRESBYOND)\n普通眼科与白内障手术", '英语、华语、马来语'],
            ['dr-marcus', 'DR MARCUS NG KANG KOK', 'dr-marcus2022.jpg', 'MBBS (Taiwan), M.S. Ophthal (UKM)', 'Muar, Segamat'],
            ['dr-leow', 'DR LEOW SUE NGEIN', 'dr-leow.jpg', 'MD (UKM), M.S Ophthalmology (UKM), CMIA (Malaysia)', 'Johor Bahru'],
            ['dr-ang', 'DR ANG EE LING', 'dr-ang.jpg', 'MBBS. MSOphthal (UM), Fellowship in Vitreoretinal Surgery Malaysia and Sydney', 'Penang'],
            ['dr-suresh', 'DR SURESH SUBRAMANIAM', 'dr-suresh2022.jpg', 'MD (Bandung), M.Med Ophth (USM), Glaucoma Fellowship (MOH) & (SNUH, Seoul), CCFT Glaucoma (MOH), CMIA (NIOSH), AM', 'Ipoh'],
            ['dr-edwin', 'DR EDWIN OOI INN LOON', 'dr-edwin2022.jpg', 'MD (UKM), M.S Ophthal (UKM)', 'Penang'],
            ['dr-faith', 'DR FAITH HO FUI LI', 'dr-faith.jpg', 'MD (UKM), Dr.Ophth (UKM)', 'Kuching'],
            ['dr-tang', 'DR TANG SENG FAI', 'dr-tang2022.jpg', 'MD (UKM), Dr Ophthal (UKM), Fellowship in Glaucoma (UKM)', 'Klang, TTDI'],
            ['dr-siuw', 'DR SIUW CHIN PEI', 'dr-siuw2022.jpg', 'MBBS (IMU), Doctor of Ophthalmology (UKM)', 'Johor Bahru, Sutera'],
            ['dr-gan', 'DR GAN SAY SEONG', 'dr-gan2022.jpg', 'MBBS (UM), MS (Ophth) UKM', 'Bahau, Seremban'],
            ['dr-anhar', 'DR ANHAR HAFIZ BIN SILIM', 'dr-anhar.jpg', "MBBS (Jordan), Doctor Of Ophthalmology (UKM), Fellowship in Vitreoretinal Surgery (CCFT, M'sia)", 'Shah Alam'],
            ['dr-syafiq', 'DR MOHD. SYAFIQ BIN AZMAN', 'dr-syafiq.jpg', "MBBS (UIAM)\nDoctor Of Ophthalmology (UKM)", 'Seremban'],
            ['dr-cassandra', 'DR CASSANDRA LO YEE LIN', 'dr-cass.webp', "MD (KSMU)\nMS Ophthal (UKM)", 'OUG'],
            ['dr-ng', 'DR NG CHUN WAI', 'dr-chun.webp', "MD (UCSI)\nDoctor of Ophthalmology (UKM), CMIA (NIOSH)", 'Kepong, TTDI, Damansara Jaya'],
            ['dr-miswan', 'DR MISWAN MUIZ MAHYUDIN', 'dr-muiz.webp', 'MOphthal (Malaya), MBChB (Otago,NZ)', 'Damansara Jaya, Cheras, Melawati'],
            ['dr-ivan', 'DR IVAN CHONG JIA CHERNG', 'dr-ivan.webp', 'MBBS (IMU) & MOphthal (UM)', 'Kota Kinabalu'],
            ['dr-chong', 'DR CHONG KA LUNG', 'dr-chong.webp', "MBBS (IMU), MOphthal (UM), Vitreoretinal Fellowship (Australia), Subspecialty Vitreoretinal Fellowship (Ministry of Health, CCFT, M'sia), CMIA (NIOSH), (AM, AMM).", 'Seremban'],
            ['dr-teo', 'DR. TEO SHEE KIANG', 'dr-teo.webp', 'MD (UKM), Doctor of Ophthalmology (UKM)', 'Johor Bahru'],
            ['dr-alex', 'DR ALEX YEE CHAU SIM', 'dr-alex.webp', "MD (UKM),\nDoctor of Ophthalmology (UKM)", 'Klang, Shah Alam, Kota Kemuning, Cheras'],
            ['dr-woo', 'DR WOO QI JIE', 'dr-woo.webp', "Doctor Of Medicine (RUSSIA)\nMaster In Plastic Surgery (USM)", '', 'Plastic Surgeon'],
            ['dr-limyeewoon', 'DR LIM YEE WOON', 'dr-limyeewoon.webp', "Doctor Of Medicine, MD (USM)\nMaster Of Anaesthesiology (UM)", '', 'Anaesthetist'],
            ['dr-luen', 'DR KOH KHAI LUEN', 'dr-luen.webp', "MBBS (IMU), MRCS (Ire),\nMS (Plastic Surgery, USM)", '', 'Plastic Surgeon'],
        ];

        $defaultPosition = '眼科顾问医生';
        $defaultSpecialty = "LASIK / 激光屈光治疗 (SMILE Pro, SMILE, FemtoLASIK, ASA, TESA, PRESBYOND)\n普通眼科与白内障手术";
        $defaultLanguages = '英语、华语、马来语';

        foreach ($doctors as $index => $doctor) {
            [$slug, $name, $photo, $qualification, $branches, $position, $specialty, $languages] = array_pad($doctor, 8, null);

            if ($slug === 'dr-stephen') {
                $position = "眼科顾问医生\n屈光手术医生\n医疗主任";
                $specialty = 'LASIK / 激光屈光治疗 (SMILE Pro, FemtoLASIK, ASA, PRESBYOND)';
                $languages = '英语';
            }

            $position ??= $branches ? $defaultPosition : '专科医生';
            $languages ??= $defaultLanguages;

            if ($specialty === null) {
                $qualificationText = strtolower($qualification);
                $positionText = strtolower($position);

                $specialty = match (true) {
                    str_contains($positionText, 'plastic') || str_contains($name, 'WOO') || str_contains($name, 'KOH') => '整形外科',
                    str_contains($positionText, 'anaesthetist') || str_contains($name, 'LIM YEE WOON') => '麻醉科',
                    str_contains($qualificationText, 'glaucoma') => "青光眼诊疗\n普通眼科与白内障手术",
                    str_contains($qualificationText, 'vitreoretinal') => "视网膜及玻璃体视网膜疾病\n普通眼科与白内障手术",
                    default => $defaultSpecialty,
                };
            }

            Doctor::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'photo' => 'doctors/' . $photo,
                    'position' => $position,
                    'qualification' => $qualification,
                    'specialty' => $specialty,
                    'languages' => $languages,
                    'branches' => $branches,
                    'detail_url' => $slug . '.html',
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }

        Menu::query()
            ->where('location', 'header')
            ->get()
            ->each(function (Menu $menu): void {
                $menu->items()->where('title', '我们的专科医生')->update(['url' => 'doctors.html']);
            });
    }
}
