<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\ServiceSectionItem;
use Illuminate\Database\Seeder;

class EyeDiseaseDetailsSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'dry-eyes' => [
                'title' => '干眼症',
                'short_title' => '干眼症',
                'summary' => '干眼是一种常见的病症，当泪液不足，无法帮助润滑和滋养眼睛时，就会出现眼睛干涩的状态。',
                'intro_title' => '马来西亚 <strong>干眼症</strong> 专科',
                'intro_description' => '干眼是一种常见的病症，即当一个人的泪液不足，无法帮助润滑和滋养眼睛时就会出现眼睛干涩的状态。',
                'intro_image' => 'static/picture/dry-eye.jpg',
                'benefits_title' => null,
                'section_title' => '<strong>干眼</strong> 的病因',
                'section_description' => "干眼是基于泪液产生不足，或所产生的泪液蒸发速度太快所致。导致眼睛干涩的常见原因为：\n- 隐形眼镜配戴者\n- 工作于空调环境中者\n- 高度使用电脑者\n## 体征和症状：\n- 眼睛疼痛和泛红\n- 眼睛有刺痛或灼热感\n- 眼影有沙质或刺感\n- 出现暂时性视力模糊\n- 在隐形眼镜配戴时感觉不适\n- 过度溢泪\n## 主要原因：\n- 泪液不足\n- 环境干燥，多尘和多风\n- 过度使用电脑和手机\n- 老化\n- 有隐藏性系统疾病\n- 某些药物所致（抗组胺药，避孕药等）\n眼睛干涩通常是由睑板腺功能障碍（MGD）和睑缘炎（Blepharitis）所引起。\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>干眼症</strong> 治疗',
                'item_description' => "干眼症治疗方法包括改变工作习惯，使用人工泪液（眼药水）和使用泪点栓塞疗法，E-Eye / IRPL 和 Blephex 仪器治疗。\n<strong>缓解干眼症症状的步骤</strong>\n<strong>步骤一是正确诊断</strong>\nTear Lab 是用于测量干眼症严重程度的设备。这是唯一一个可测量泪液渗透压，同时测试泪液质量并进行客观评估的方法。",
                'item_image' => 'static/picture/tear-lab.png',
            ],
            'conjunctivitis' => [
                'title' => '结膜炎',
                'short_title' => '结膜炎',
                'summary' => '结膜炎会使结膜肿胀，结膜是覆盖眼睛白色部分和内眼睑的薄膜。',
                'intro_title' => '马来西亚 <strong>结膜炎</strong> 专科',
                'intro_description' => '结膜炎使结膜肿胀，结膜是覆盖眼睛的白色部分和内眼睑的薄膜。',
                'intro_image' => 'static/picture/conjunctivitis.jpg',
                'benefits_title' => null,
                'section_title' => '<strong>结膜炎</strong> 的病因（红眼）',
                'section_description' => "结膜炎的病因可能是因多种原因引起的，例如细菌、病毒、过敏、佩戴隐形眼镜或罕见情况下，因性传播疾病（STD）引起的。因此，在治疗之前必须先诊断红眼的病因。\n- 细菌或病毒感染\n- 暴露于过敏原，灰尘和烟雾\n# 体征和症状\n- 眼睛泛红及发痒\n- 过度溢泪\n- 眼睛有排泄物导致眼睑结成硬痂",
                'item_title' => '<strong>结膜炎</strong> 治疗',
                'item_description' => '治疗感染或过敏眼药水。',
                'item_image' => 'static/picture/conjunctivitis.jpg',
            ],
            'diabetic-retinopathy' => [
                'title' => '糖尿病性视网膜病变',
                'short_title' => '糖尿病性视网膜病变',
                'summary' => '糖尿病性视网膜病是糖尿病患者常见的并发症，视网膜病变是指滋养视网膜的细胞及小血管受损所致。',
                'intro_title' => '马来西亚<strong>糖尿病性视网膜病</strong>专科',
                'intro_description' => '糖尿病性视网膜病是糖尿病患者常见的并发症，视网膜病变是指滋养视网膜（眼球后部对光进行处理的组织）的细胞及小血管受损所致。',
                'intro_image' => 'static/picture/diabetic-retinopathy-vision.jpg',
                'benefits_title' => '图：糖尿病性视网膜病变的视力（左）正常视力（右）',
                'section_title' => '<strong>糖尿病性视网膜病</strong>的病因',
                'section_description' => "这是因糖尿病患者的血糖水平升高（高血糖）导致以下状况：\n- 视网膜毛细血管渗漏和阻塞\n- 视网膜及黄斑水肿\n- 新血管和纤维组织的形成 - 于增生性视网膜病变\n# 体征和症状\n早期糖尿病性视网膜病一般是无症状的。然而随着病情恶化，您可能会发现：\n- 视线中心会出现黑点或空白\n- 视物变形\n- 中心视力下降\n- 视力严重丧失\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>糖尿病性视网膜病</strong>的治疗',
                'item_description' => "- 激光治疗可封闭渗漏的血管或抑制新血管增生。\n- 玻璃体切除术（外科手术）可去除和替代眼后的凝胶状液体，这称为玻璃体。一般上增生性糖尿病视网膜病变患者或需进行此手术。",
                'item_image' => 'static/picture/diabetic-retinopathy.jpg',
            ],
            'aged-related-macular-degeneration' => [
                'title' => '老年性黄斑部病变',
                'short_title' => '老年性黄斑部病变',
                'summary' => '老年性黄斑部病变会导致黄斑受损，使中心视力快速减退。',
                'intro_title' => '<strong>老年性黄斑部病变</strong> 专科',
                'intro_description' => '老年性黄斑部病变会导致黄斑受损，使中心视力快速减退的一种疾病，黄斑部是眼球后部视网膜最中央的一块小区域。导致老年性黄斑部病变的风险因素包括吸烟和有老年性黄斑部病变家族病史。',
                'intro_image' => 'static/picture/age-related-macular-degeneration.jpg',
                'benefits_title' => null,
                'section_title' => '<strong>老年性黄斑部病变</strong> 的病因',
                'section_description' => "- 老化\n- 吸烟\n- 过度日晒\n# 体征和症状\n- 中央视觉出现模糊和视物变形\n- 对强光敏感\n- 昏暗地方视力不佳\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>老年性黄斑部病变</strong> 的治疗',
                'item_description' => "- 干性老年性黄斑部病变：需要（自行）监督\n- 湿性老年性黄斑部病变：可进行激光治疗和玻璃体内注射（药物）",
                'item_image' => 'static/picture/amd.jpg',
            ],
            'retinal-detachment' => [
                'title' => '视网膜脱落',
                'short_title' => '视网膜脱落',
                'summary' => '视网膜脱落是因视网膜从下层支撑组织上剥离下来而导致的急性眼部疾病。',
                'intro_title' => '马来西亚 <strong>视网膜脱落</strong> 专科',
                'intro_description' => '视网膜脱落是因视网膜从下层支撑组织上剥离下来而导致的急性眼部疾病，这属于紧急医疗事件。',
                'intro_image' => 'static/picture/retinal-detachment.jpg',
                'benefits_title' => '图：视网膜脱落视力',
                'section_title' => '<strong>视网膜脱落</strong> 的病因',
                'section_description' => "视网膜脱落（RD）是指视网膜脱离或脱落自其原始位置。视网膜脱落可发生于任何年龄，而更高发生于以下人群：\n- 极高度近视（近视）\n- 有视网膜脱落的既往病史\n- 有视网膜脱落的家族病史\n- 后部玻璃体脱离（PVD）- 玻璃体缓慢收缩并与视网膜表面剥离\n- 眼睛受伤\n- 糖尿病\n- 白内障手术并发症\n# 体征和症状\n- 飞蚊症次数增加\n- 强光增加\n- 丧失周围或侧面视力\n- 出现帘状阴影并遮盖视线\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>视网膜脱落</strong> 治疗',
                'item_description' => "若不立即进行治疗，视网膜脱落会导致永久性视力丧失。\n- 手术治疗",
                'item_image' => 'static/picture/retinal-detachment2.jpg',
            ],
            'pterygium' => [
                'title' => '翼状胬肉',
                'short_title' => '翼状胬肉',
                'summary' => '翼状胬肉受外界刺激，特别是过度暴露于紫外线下而引起。',
                'intro_title' => '马来西亚 <strong>翼状胬肉</strong> 专科',
                'intro_description' => '翼状胬肉（pterygium）受外界刺激，特别是过度暴露于紫外线下而引起的局部球结膜纤维血管组织增生。',
                'intro_image' => 'static/picture/pterygium.jpg',
                'benefits_title' => null,
                'section_title' => '<strong>翼状胬肉</strong> 的病因',
                'section_description' => "翼状胬肉是一种无痛增生，既有一层清晰且薄的组织，生长在眼白部分。其通常是无害的。\n- 过度日晒\n# 体征和症状\n- 眼睛表面有刺激感\n- 干眼症\n- 异物感\n- 不规则散光造成的视力模糊（严重阶段）",
                'item_title' => '<strong>翼状胬肉</strong> 的治疗',
                'item_description' => '必要时需进行手术切除。',
                'item_image' => 'static/picture/pterygium.jpg',
            ],
            'keratoconus' => [
                'title' => '圆锥角膜',
                'short_title' => '圆锥角膜',
                'summary' => '圆锥角膜是一种以角膜中央变薄向前突出，呈圆锥形为特征的眼睛疾病。',
                'intro_title' => '马来西亚 <strong>圆锥角膜</strong> 专科',
                'intro_description' => '圆锥角膜是一种以角膜中央变薄向前突出，呈圆锥形为特征的一种眼睛疾病。若不及时治疗，会导致视力下降。',
                'intro_image' => 'static/picture/keratoconus.jpg',
                'benefits_title' => '图：正常角膜（左）圆锥角膜（右）',
                'section_title' => '<strong>圆锥角膜</strong> 的病因',
                'section_description' => "圆锥角膜是一种常见进展性，角膜局部扩张性疾病，以中央角膜基质变薄、中央顶点呈圆锥形突出变形，角膜失去正常的弧形继而导致不规则散光。\n## 谁是风险群？\n- 有家族病史\n- 高度散光\n- 慢性眼部过敏和揉眼\n# 体征和症状\n- 视物变形\n- 对强光敏感\n- 一只眼睛有复视\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>圆锥角膜</strong> 治疗',
                'item_description' => "硬性透氧性隐形眼镜（RGP）\n在早期阶段，可使用眼镜或软性隐形眼镜来矫正视力。然而随着角膜逐渐变薄和变陡，则需要使用硬性透氧性隐形眼镜（RGP）或专业性（圆锥角膜）隐形眼镜，促使可取得更好的视力。\n手术治疗\n角膜交联也是其中控制圆锥角膜继续恶化的另一种选择。在晚期病例中，可能需要进行角膜移植。",
                'item_image' => 'static/picture/keratoconus2.jpg',
            ],
            'ptosis-surgery' => [
                'title' => '眼睑疾病',
                'short_title' => '眼睑疾病',
                'summary' => '眼睑疾病通常指上眼睑下垂，会阻碍视力并影响美容外观。',
                'intro_title' => '马来西亚 <strong>眼睑外科</strong> 专科',
                'intro_description' => '通常指上眼睑下垂，表现为上眼睑部分或完全不能抬起，致上眼睑下缘遮盖角膜上缘过多，它会阻碍视力并影响美容外观。',
                'intro_image' => null,
                'benefits_title' => null,
                'section_title' => '<strong>眼睑下垂</strong> 的病因',
                'section_description' => "- 这是给予眼睑肌肉异常发育或减弱所致\n- 眼睑下垂治疗包括通过手术进行眼睑提升术，以改善视力和美容外观的效果",
                'item_title' => '<strong>眼睑疾病</strong> 治疗',
                'item_description' => '眼睑下垂治疗包括通过手术进行眼睑提升术，以改善视力和美容外观的效果。',
                'item_image' => 'static/image/ptosis.jpg',
            ],
            'eye-examinations' => [
                'title' => '眼睛检查',
                'short_title' => '眼睛检查',
                'summary' => 'Optimax 全面眼睛检查通过医学手段和方法对受检者眼部进行全面性检查。',
                'intro_title' => '<strong>Optimax</strong> 全面眼睛检查',
                'intro_description' => 'Optimax全面眼睛检查是超越普通的眼睛检查方式，其通过医学手段和方法对受检者的眼部进行全面性检查，让您更了解您珍贵双眼的功能及视力，以更有效地预防和控制眼部疾病及保护眼睛。',
                'intro_image' => 'static/picture/eye-exam2.jpg',
                'benefits_title' => null,
                'section_title' => '<strong>全面眼睛检查</strong>',
                'section_description' => "全面眼睛检查可分为六个主要部分，分别是：视力，角膜，眼睛外部健康，眼睛肌肉功能，眼内健康，同时也备有为您和您的家人进行的个人咨询和问答环节。\nOptimax全面眼睛检查所进行的测试类型包括：\n- 弱视/懒惰眼评估\n- 视敏度\n- 屈光 - 眼力测量\n- 色觉测试\n- 眼睛肌肉评估\n- 眼睛外部检查\n- 角膜地形图（角膜映射）\n- 角膜测厚法（角膜厚度）\n- 干眼症评估\n- 眼内压测量（眼内压）\n- 眼晶状体检查\n- 眼底检查\n以上测试将可为我们提供关于您的眼睛健康足够的信息，以协助为您提供眼睛健康、视力状况及治疗适用性的建议。\n[button]static/file/optiheal_CN.pdf",
                'item_title' => '<strong>特殊诊断测试</strong>',
                'item_description' => "- 视野测量（VFT）\n- 光学相干断层扫描（OCT）\n- 光学相干断层扫描血管造影（OCTA）\n- 眼底摄影",
                'item_image' => 'static/picture/iop.png',
            ],
        ];

        foreach ($pages as $slug => $data) {
            $service = Service::query()->where('slug', $slug)->first();

            if (! $service) {
                continue;
            }

            $service->update([
                'title' => $data['title'],
                'short_title' => $data['short_title'],
                'summary' => $data['summary'],
                'intro_title' => $data['intro_title'],
                'intro_description' => $data['intro_description'],
                'hero_image' => 'static/image/hero29.jpg',
                'benefits_title' => $data['benefits_title'],
                'brochure_pdf' => 'static/file/optiheal_CN.pdf',
                'is_active' => true,
            ]);

            ServiceSection::query()
                ->where('service_id', $service->id)
                ->whereIn('type', ['intro_image', 'two_column'])
                ->get()
                ->each(function (ServiceSection $section): void {
                    $section->items()->delete();
                    $section->delete();
                });

            if ($data['intro_image']) {
                ServiceSection::query()->create([
                    'service_id' => $service->id,
                    'type' => 'intro_image',
                    'image' => $data['intro_image'],
                    'sort_order' => 0,
                    'is_active' => true,
                ]);
            }

            $section = ServiceSection::query()->create([
                'service_id' => $service->id,
                'type' => 'two_column',
                'title' => $data['section_title'],
                'description' => $data['section_description'],
                'sort_order' => 1,
                'is_active' => true,
            ]);

            ServiceSectionItem::query()->create([
                'service_section_id' => $section->id,
                'title' => $data['item_title'],
                'description' => $data['item_description'],
                'image' => $data['item_image'],
                'sort_order' => 1,
                'is_active' => true,
            ]);
        }
    }
}
