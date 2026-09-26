# 宝塔面板安装说明

本文档用于将 Ruixi 项目部署到宝塔面板服务器。项目是 Laravel 12 + Filament 5 应用，不是普通静态站点，部署时必须把网站运行目录指向 `public`，并配置 Laravel 的伪静态规则。

## 一、服务器环境要求

建议环境：

- 宝塔 Linux 面板
- Nginx 1.22+ 或 Apache 2.4+
- PHP 8.2 或更高版本
- MySQL 5.7+ / MySQL 8.0 / MariaDB 10.3+
- Composer 2.x
- Git

PHP 必须安装或启用以下常见扩展：

- `fileinfo`
- `openssl`
- `pdo`
- `pdo_mysql`
- `mbstring`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `curl`
- `zip`
- `gd`
- `intl`

如果后台上传图片、PDF 或视频，建议在 PHP 设置中调整：

```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 256M
max_execution_time = 300
```

## 二、创建站点

在宝塔面板中进入：

```text
网站 -> 添加站点
```

建议填写：

- 域名：填写正式域名，例如 `example.com`
- 根目录：先选择 `/www/wwwroot/ruixi`
- 数据库：创建 MySQL 数据库
- PHP 版本：选择 PHP 8.2+

创建完成后，网站目录示例为：

```text
/www/wwwroot/ruixi
```

## 三、上传或拉取代码

### 方式一：Git 拉取

进入服务器 SSH：

```bash
cd /www/wwwroot
git clone https://github.com/worryfreezzy-spec/Ruixi.git ruixi
cd /www/wwwroot/ruixi
```

如果目录已存在，可以进入目录后拉取：

```bash
cd /www/wwwroot/ruixi
git pull
```

### 方式二：手动上传

也可以通过宝塔文件管理上传压缩包，然后解压到：

```text
/www/wwwroot/ruixi
```

注意不要只上传 `public` 目录，Laravel 项目需要完整项目文件。

## 四、安装 Composer 依赖

进入项目目录：

```bash
cd /www/wwwroot/ruixi
composer install --no-dev --optimize-autoloader
```

如果宝塔服务器没有全局 Composer，可以在宝塔软件商店安装 Composer，或使用宝塔终端里可用的 Composer 命令。

不要上传本地的 `vendor` 目录作为正式部署方案，正式环境应在服务器执行 `composer install`。

## 五、配置 .env

复制环境配置：

```bash
cp .env.example .env
```

编辑 `.env`：

```env
APP_NAME=Ruixi
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://你的域名

APP_LOCALE=zh_CN
APP_FALLBACK_LOCALE=zh_CN

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=你的数据库名
DB_USERNAME=你的数据库用户名
DB_PASSWORD=你的数据库密码

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

生成应用密钥：

```bash
php artisan key:generate
```

注意：

- `APP_URL` 必须改成正式访问域名。
- 正式环境必须设置 `APP_DEBUG=false`。
- 数据库账号密码以宝塔创建数据库时的信息为准。
- 不要把服务器 `.env` 提交到 Git。

## 六、导入数据库结构和基础内容

首次安装可执行：

```bash
php artisan migrate --force
php artisan db:seed --force
```

如果是全新服务器、确定数据库可以清空，也可以执行：

```bash
php artisan migrate:fresh --seed --force
```

生产环境慎用 `migrate:fresh`，它会删除并重建所有数据表。

## 七、设置网站运行目录

这是最重要的一步。

宝塔面板进入：

```text
网站 -> 目标站点 -> 设置 -> 网站目录
```

把运行目录设置为：

```text
/public
```

最终实际 Web 根目录应为：

```text
/www/wwwroot/ruixi/public
```

如果运行目录没有指向 `public`，会出现：

- Laravel 源码暴露风险
- 首页或子页面打不开
- 静态资源路径异常
- `.env` 等敏感文件可能被访问

## 八、配置伪静态

宝塔面板进入：

```text
网站 -> 目标站点 -> 设置 -> 伪静态
```

Nginx 使用以下规则：

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

保存后重载 Nginx。

如果首页能打开，但 `/about`、`/contact`、`/admin` 等子页面 404，通常就是运行目录或伪静态没有配置正确。

## 九、目录权限

Laravel 需要写入以下目录：

```text
storage
bootstrap/cache
```

在 SSH 中执行：

```bash
cd /www/wwwroot/ruixi
chown -R www:www storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

如果服务器 Web 用户不是 `www`，以宝塔实际运行用户为准。

## 十、缓存优化

部署完成后执行：

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

如果后续修改了 `.env`、路由、配置或视图，记得重新清理并生成缓存。

## 十一、后台入口

后台地址：

```text
https://你的域名/admin
```

本地开发环境使用过简化登录方式。正式服务器请确认数据库中已有后台用户，并在上线后及时修改默认密码。

如果需要重新创建管理员，可以通过 Laravel 命令、数据库或项目已有用户逻辑处理。不要在正式环境长期使用简单密码。

## 十二、静态资源与上传文件

项目静态资源主要位于：

```text
public/static
```

包括：

- CSS
- 图片
- PDF 文件
- 视频文件

如果后台上传文件需要公开访问，Laravel 通常还需要：

```bash
php artisan storage:link
```

当前项目前台主要使用 `public/static` 下的固定资源，迁移服务器时必须完整上传该目录。

## 十三、SSL 配置

宝塔面板进入：

```text
网站 -> 目标站点 -> SSL
```

申请 Let's Encrypt 证书或上传商业证书。

启用 HTTPS 后，确认 `.env` 中：

```env
APP_URL=https://你的域名
```

如果出现样式、图片或跳转协议异常，优先检查 `APP_URL` 和缓存。

## 十四、上线检查清单

上线前逐项检查：

- PHP 版本为 8.2+
- Composer 依赖安装成功
- `.env` 已配置正式数据库
- `APP_KEY` 已生成
- `APP_DEBUG=false`
- 网站运行目录是 `public`
- Nginx 伪静态已设置 `try_files`
- `storage` 和 `bootstrap/cache` 可写
- 数据库迁移和 Seeder 已执行
- 首页 `/` 可访问
- 子页面 `/about`、`/contact`、`/laser-vision-correction` 可访问
- 后台 `/admin` 可访问
- 表单提交功能可用
- 图片、PDF、视频资源可访问
- SSL 证书已开启

## 十五、常见问题

### 1. 首页正常，子页面 404

优先检查：

- 网站运行目录是否为 `public`
- Nginx 伪静态是否包含 `try_files $uri $uri/ /index.php?$query_string`
- 宝塔是否已重载 Nginx

### 2. 页面 500

检查 Laravel 日志：

```bash
tail -n 100 storage/logs/laravel.log
```

常见原因：

- `.env` 数据库账号密码错误
- 没有执行 `php artisan key:generate`
- `storage` 或 `bootstrap/cache` 不可写
- 缺少 PHP 扩展
- 修改 `.env` 后没有清理缓存

### 3. 后台打不开

检查：

- `/admin` 路由是否能访问
- 伪静态是否正确
- 数据库是否已迁移
- 是否已有后台用户
- Laravel 日志中是否有 Filament 或数据库错误

### 4. 图片或视频不显示

检查：

- `public/static` 是否完整上传
- 文件大小写是否和代码路径一致
- Nginx 是否禁止访问相关后缀
- 文件权限是否可读

### 5. 修改 .env 后不生效

执行：

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

## 十六、推荐部署命令汇总

首次部署可参考：

```bash
cd /www/wwwroot/ruixi
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
chown -R www:www storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

后续更新代码可参考：

```bash
cd /www/wwwroot/ruixi
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
