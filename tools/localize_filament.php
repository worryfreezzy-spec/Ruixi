<?php

$root = dirname(__DIR__);
$resourcesPath = $root . '/app/Filament/Admin/Resources';

$resourceMeta = [
    'SiteSettingResource.php' => ['网站设置', '网站设置', '系统设置', 10],
    'PageResource.php' => ['页面', '页面管理', '内容管理', 20],
    'PageSectionResource.php' => ['页面区块', '页面区块', '内容管理', 30],
    'SectionItemResource.php' => ['区块项目', '区块项目', '内容管理', 40],
    'MenuResource.php' => ['导航', '导航管理', '导航管理', 50],
    'MenuItemResource.php' => ['导航项', '导航项', '导航管理', 60],
    'ServiceCategoryResource.php' => ['服务分类', '服务分类', '服务管理', 70],
    'ServiceResource.php' => ['服务项目', '服务项目', '服务管理', 80],
    'ServiceSectionResource.php' => ['服务详情区块', '服务详情区块', '服务管理', 90],
    'ServiceSectionItemResource.php' => ['服务区块项目', '服务区块项目', '服务管理', 100],
    'DoctorResource.php' => ['医生', '医生管理', '医生管理', 110],
    'DoctorSectionResource.php' => ['医生资料区块', '医生资料区块', '医生管理', 120],
    'AwardResource.php' => ['奖项', '奖项管理', '品牌资料', 130],
    'PartnerResource.php' => ['保险/TPA', '保险/TPA', '品牌资料', 140],
    'ContactFormResource.php' => ['联系表单', '联系表单', '表单管理', 150],
    'ContactFormFieldResource.php' => ['表单字段', '表单字段', '表单管理', 160],
    'ContactSubmissionResource.php' => ['留言提交', '留言提交', '表单管理', 170],
    'SeoMetaResource.php' => ['SEO资料', 'SEO管理', 'SEO管理', 180],
];

$labels = [
    'id' => 'ID',
    'site_name' => '网站名称',
    'logo' => 'Logo',
    'favicon' => '网站图标',
    'hotline' => '热线电话',
    'whatsapp_number' => 'WhatsApp号码',
    'whatsapp_url' => 'WhatsApp链接',
    'facebook_url' => 'Facebook链接',
    'instagram_url' => 'Instagram链接',
    'english_button_enabled' => '显示英文切换按钮',
    'english_button_url' => '英文按钮链接',
    'footer_license_text' => '页脚许可证文字',
    'copyright_text' => '版权文字',
    'terms_page_id' => '条款页面',
    'privacy_page_id' => '隐私政策页面',
    'parent_id' => '上级',
    'parent.title' => '上级',
    'title' => '标题',
    'slug' => '路径标识',
    'template' => '页面模板',
    'hero_title' => '横幅标题',
    'hero_subtitle' => '横幅副标题',
    'hero_image' => '横幅图片',
    'breadcrumb_title' => '面包屑标题',
    'summary' => '摘要',
    'is_active' => '启用',
    'sort_order' => '排序',
    'created_at' => '创建时间',
    'updated_at' => '更新时间',
    'name' => '名称',
    'location' => '位置',
    'menu_id' => '所属导航',
    'menu.name' => '所属导航',
    'page_id' => '关联页面',
    'page.title' => '关联页面',
    'url' => '链接',
    'target' => '打开方式',
    'icon' => '图标',
    'type' => '类型',
    'description' => '说明',
    'image' => '图片',
    'background_image' => '背景图片',
    'button_text' => '按钮文字',
    'button_url' => '按钮链接',
    'layout' => '布局',
    'section_id' => '所属区块',
    'section.title' => '所属区块',
    'subtitle' => '副标题',
    'extra_label' => '附加标签',
    'category_id' => '所属分类',
    'category.title' => '所属分类',
    'short_title' => '短标题',
    'thumbnail' => '缩略图',
    'intro_title' => '介绍标题',
    'intro_description' => '介绍说明',
    'benefits_title' => '优势标题',
    'is_featured' => '首页推荐',
    'service_id' => '所属服务',
    'service.title' => '所属服务',
    'service_section_id' => '所属服务区块',
    'serviceSection.title' => '所属服务区块',
    'photo' => '照片',
    'position' => '职位',
    'specialty' => '专长',
    'qualification' => '资质',
    'short_bio' => '简短简介',
    'profile_intro' => '个人介绍',
    'doctor_id' => '所属医生',
    'doctor.name' => '所属医生',
    'content' => '内容',
    'year' => '年份',
    'form_id' => '所属表单',
    'form.name' => '所属表单',
    'label' => '标签',
    'placeholder' => '占位文字',
    'options' => '选项',
    'is_required' => '必填',
    'data' => '提交数据',
    'phone' => '电话',
    'email' => '邮箱/账号',
    'message' => '留言',
    'status' => '状态',
    'remark' => '备注',
    'model_type' => '模型类型',
    'model_id' => '模型ID',
    'meta_title' => 'SEO标题',
    'meta_description' => 'SEO描述',
    'meta_keywords' => 'SEO关键词',
    'og_title' => '分享标题',
    'og_description' => '分享描述',
    'og_image' => '分享图片',
    'canonical_url' => '规范链接',
];

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($resourcesPath));

foreach ($iterator as $file) {
    if (! $file->isFile() || $file->getExtension() !== 'php') {
        continue;
    }

    $path = $file->getPathname();
    $content = file_get_contents($path);
    $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);

    if (isset($resourceMeta[$file->getFilename()])) {
        [$modelLabel, $pluralModelLabel, $navigationGroup, $navigationSort] = $resourceMeta[$file->getFilename()];
        $navigationLabel = $pluralModelLabel;

        $props = <<<PHP
    protected static ?string \$modelLabel = '{$modelLabel}';

    protected static ?string \$pluralModelLabel = '{$pluralModelLabel}';

    protected static ?string \$navigationLabel = '{$navigationLabel}';

    protected static string | \\UnitEnum | null \$navigationGroup = '{$navigationGroup}';

    protected static ?int \$navigationSort = {$navigationSort};

PHP;

        $content = preg_replace('/\n    protected static \?string \$modelLabel = .*?\n\n    protected static \?string \$pluralModelLabel = .*?\n\n    protected static \?string \$navigationLabel = .*?\n\n    protected static string \| \\\\UnitEnum \| null \$navigationGroup = .*?\n\n    protected static \?int \$navigationSort = .*?\n/s', "\n{$props}", $content);

        if (! str_contains($content, '$modelLabel')) {
            $content = preg_replace('/(protected static string\|BackedEnum\|null \$navigationIcon = [^;]+;\n)/', "$1{$props}", $content, 1);
        }
    }

    $content = preg_replace_callback(
        "/((?:TextInput|Textarea|Toggle|Select|FileUpload|TextColumn|IconColumn|ImageColumn|KeyValue|CheckboxList)::make\\('([^']+)'\\))(?!\\s*->label\\()/",
        static function (array $matches) use ($labels): string {
            $field = $matches[2];

            if (! isset($labels[$field])) {
                return $matches[1];
            }

            return $matches[1] . "\n                    ->label('{$labels[$field]}')";
        },
        $content,
    );

    file_put_contents($path, $content);
}

echo "Localized Filament resources.\n";
