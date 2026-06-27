# Ruixi

瑞熙医疗整形网站重建项目。

本项目基于 Laravel 12 + Filament 5 搭建，用于重建并维护瑞熙医疗整形相关网站内容。项目目标不是做成通用 CMS，而是围绕现有站点页面结构建立可控、可维护的业务后台，让首页、医生团队、诊疗服务、分院联系、SEO、页脚导航等内容可以按固定模块管理。

## 项目定位

这是一个面向医疗与眼科/医美内容展示的网站系统，前台页面尽量保持参考站点的页面结构和视觉节奏，后台则提供结构化字段，避免把整页内容塞进一个大型富文本编辑器。

当前项目包含：

- 前台官网页面
- Filament 后台管理面板
- 医生、服务、文章式详情页等结构化内容模型
- 联系表单与提交记录
- 分院城市与分院信息管理
- SEO meta 管理
- 静态资源与旧 HTML 页面兼容入口

## 技术栈

- PHP 8.2+
- Laravel 12
- Filament 5
- MySQL / MariaDB
- Vite
- phpstudy 本地运行环境

## 主要前台页面

项目已配置以下主要页面路由：

- 首页：`/`
- 关于我们：`/about`、`/about.html`
- CEO 页面：`/ceo`、`/ceo.html`
- 医生团队：`/doctors`、`/doctors.html`
- 医生详情：`/dr-{slug}`、`/dr-{slug}.html`
- 为什么选择我们：`/why-choose-us`、`/why-choose-us.html`
- 白内障服务：`/cataract`、`/cataract.html`
- 眼疾管理：`/eye-diseases-management`、`/eye-diseases-management.html`
- 激光视力矫正：`/laser-vision-correction`、`/laser-vision-correction.html`
- 儿童眼科：`/kids`、`/kids.html`
- 医美整形：`/plastic-surgery`、`/plastic-surgery.html`
- 联系我们：`/contact`、`/contact.html`
- 分院页面：如 `/johor`、`/johor.html`

同时保留部分旧 HTML 访问方式，便于迁移期间兼容旧链接。

## 后台管理模块

后台基于 Filament 构建，主要资源包括：

- 站点设置：基础文案、按钮、全局内容
- Banner：桌面端与移动端图片、排序、启用状态
- 菜单与页脚菜单：导航结构维护
- 页面与页面区块：通用页面结构化内容
- 医生与医生区块：医生资料、介绍、详情内容
- 服务分类与服务：LASIK、白内障、儿童眼科等服务内容
- 服务详情区块：详情页中的图文模块、步骤、优势、适合人群等
- 眼疾分类与眼疾详情
- 儿童眼科分类与服务内容
- 医美整形页面与项目
- 分院城市与分院信息
- 联系页内容与联系表单提交
- SEO meta：按页面路径维护标题、描述等
- 奖项、合作伙伴、优势模块等首页/公共展示内容

## 本地运行

建议在 phpstudy 环境中运行。本项目当前开发环境为 Windows + phpstudy。

常用命令：

```bash
composer install
php artisan migrate
php artisan db:seed
php artisan serve
```

如果本机没有把 PHP 或 Composer 加入 PATH，需要使用 phpstudy 中的完整 PHP 路径执行命令，例如：

```powershell
D:\phpstudy\Extensions\php\php8.2.9nts\php.exe artisan migrate
D:\phpstudy\Extensions\php\php8.2.9nts\php.exe artisan db:seed
```

## 后台入口

后台地址：

```text
/admin
```

本地开发环境当前使用简化登录方式，账号信息以实际数据库中的后台用户为准。

## 数据与内容初始化

项目包含多个 Seeder，用于初始化站点结构和页面内容：

- `ContentStructureSeeder`
- `AboutStorySeeder`
- `CeoPageSeeder`
- `DoctorContentSeeder`
- `WhyChooseUsSeeder`
- `CataractContentSeeder`
- `EyeDiseaseContentSeeder`
- `ChildrenContentSeeder`
- `ContactPageSeeder`
- `PlasticSurgeryContentSeeder`
- `HomeContentAssetsSeeder`

通常执行：

```bash
php artisan migrate:fresh --seed
```

即可重新生成基础内容。生产环境慎用 `migrate:fresh`，避免清空正式数据。

## 部署注意事项

Laravel 部署时 Web 根目录必须指向：

```text
public
```

Nginx 需要启用 Laravel 前端控制器规则：

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

如果首页正常但子页面 404，优先检查：

- Web 根目录是否指向 `public`
- `try_files` 是否正确转发到 `index.php`
- phpstudy Nginx 是否包含项目根目录的 `nginx.htaccess`

## 静态资源说明

项目静态资源主要放在：

- `public/static/css`
- `public/static/image`
- `public/static/picture`
- `public/static/file`
- `public/static/video`

根目录大文件不会提交到 Git。根目录 PDF 已在 `.gitignore` 中忽略，避免超过 GitHub 单文件 100MB 限制。

## 维护原则

- 优先使用后台结构化字段维护页面内容。
- 页面模块保持固定结构，减少自由富文本带来的版式失控。
- 新增服务或页面时，优先复用现有 Model、Resource、Seeder 和 Blade 结构。
- 修改前台页面时，同时检查桌面端和移动端布局。
- 修改路由时，保留 `.html` 兼容入口，避免旧链接失效。

## 仓库

GitHub 仓库：

```text
https://github.com/worryfreezzy-spec/Ruixi
```
