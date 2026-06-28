# 宝塔面板部署说明

本文档用于将 Ruixi 项目部署到宝塔面板服务器。项目是 Laravel 12 + Filament 5 应用，不是普通静态站点，网站运行目录必须指向 `public`。

## 当前正式服务器

- 域名：`http://ruixi.mbrsh.cn`
- 项目目录：`/www/wwwroot/ruixi.mbrsh.cn`
- Web 根目录：`/www/wwwroot/ruixi.mbrsh.cn/public`
- PHP：宝塔 PHP 8.3
- 数据库：MySQL，库名 `ruixi`
- 数据库用户：`ruixi`
- 后台入口：`/admin`

后续维护约定：只修改项目数据库和 `/www/wwwroot/ruixi.mbrsh.cn` 网站根目录内文件。需要修改 Nginx、PHP、MySQL 服务、宝塔站点配置等服务器配置文件时，必须先确认。

## 环境要求

- 宝塔 Linux 面板
- Nginx
- PHP 8.2 或更高，当前正式服使用 PHP 8.3
- MySQL 5.7+ / MySQL 8.0 / MariaDB 10.3+
- Composer 2.x

PHP 常用扩展：

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

如果服务器内存小于 2G，安装或编译 `fileinfo` 前建议先加 swap。

## 站点目录

宝塔添加站点后，项目完整代码放在：

```text
/www/wwwroot/ruixi.mbrsh.cn
```

宝塔站点设置里的运行目录必须设置为：

```text
/public
```

最终 Web 根目录应为：

```text
/www/wwwroot/ruixi.mbrsh.cn/public
```

如果没有指向 `public`，可能出现源码暴露、`.env` 暴露、子页面 404、后台不可访问等问题。

## 伪静态

Nginx 伪静态规则：

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

如果首页能打开，但 `/about`、`/contact`、`/admin` 等页面 404，优先检查运行目录和伪静态。

## 安装依赖

进入项目目录：

```bash
cd /www/wwwroot/ruixi.mbrsh.cn
```

安装 Composer 依赖：

```bash
export COMPOSER_ALLOW_SUPERUSER=1
export COMPOSER_CURL_DISABLE_HTTP2=1
/www/server/php/83/bin/php /tmp/composer.phar install --no-dev --optimize-autoloader --no-interaction --prefer-dist
```

如果服务器已安装全局 Composer，可以改用：

```bash
composer install --no-dev --optimize-autoloader
```

## .env 配置

正式服当前关键配置：

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://ruixi.mbrsh.cn

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ruixi
DB_USERNAME=ruixi

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

注意：

- 不要提交服务器 `.env` 到 Git。
- 修改 `.env` 后必须清缓存。
- 数据库密码以宝塔数据库页面或服务器 `.env` 为准。

## 数据库

正式服当前使用数据库：

```text
ruixi
```

当前数据库应包含 `41` 张表，关键表包括：

```text
users
sessions
cache
site_settings
page_sections
```

导入 SQL 时，建议使用项目提供的 import-safe 数据库备份，避免 mysqldump 文件头被 phpMyAdmin 静态分析误判。

导入后检查：

```bash
/www/server/php/83/bin/php artisan migrate:status
```

所有项目迁移应显示 `Ran`。

## 上传文件和图片

后台上传和数据库引用的图片主要通过 `/storage/...` 访问。部署后必须执行：

```bash
cd /www/wwwroot/ruixi.mbrsh.cn
/www/server/php/83/bin/php artisan storage:link
```

确认：

```bash
ls -la public/storage
```

应指向：

```text
storage/app/public
```

如果页面图片都不显示，优先检查 `public/storage` 是否存在。

## Livewire 静态文件

Filament 后台登录依赖 Livewire JS。当前正式服使用的路径是：

```text
public/livewire-b0eb0382/livewire.min.js
```

如果后台登录页能打开，但点击登录没反应，检查：

```bash
curl -I http://ruixi.mbrsh.cn/livewire-b0eb0382/livewire.min.js
```

应返回 `200 OK`。如果返回 `404`，可在项目根目录内复制：

```bash
mkdir -p public/livewire-b0eb0382
cp vendor/livewire/livewire/dist/livewire.min.js public/livewire-b0eb0382/livewire.min.js
cp vendor/livewire/livewire/dist/livewire.min.js.map public/livewire-b0eb0382/livewire.min.js.map
cp vendor/livewire/livewire/dist/livewire.csp.min.js.map public/livewire-b0eb0382/livewire.csp.min.js.map
chown -R www:www public/livewire-b0eb0382
```

这个处理只修改网站根目录文件，不需要修改 Nginx 配置。

## 后台登录

后台地址：

```text
http://ruixi.mbrsh.cn/admin/login
```

当前测试管理员：

```text
账号：admin
密码：admin123456
```

兼容账号：

```text
账号：admin@ruixi.local
密码：admin123456
```

上线后应尽快修改默认密码。

Filament 后台访问需要 `App\Models\User` 实现 `FilamentUser` 并允许管理员访问后台。如果登录成功后跳转 `/admin` 出现 `403 Forbidden`，优先检查 `User::canAccessPanel()`。

## 权限

Laravel 需要写入：

```text
storage
bootstrap/cache
```

执行：

```bash
cd /www/wwwroot/ruixi.mbrsh.cn
chown -R www:www storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

如果复制了公开静态资源，也建议确保属主一致：

```bash
chown -R www:www public/livewire-b0eb0382 public/storage
```

## 缓存

修改 `.env`、路由、配置、视图、Filament 或模型授权后，执行：

```bash
cd /www/wwwroot/ruixi.mbrsh.cn
/www/server/php/83/bin/php artisan optimize:clear
```

稳定后可重新生成缓存：

```bash
/www/server/php/83/bin/php artisan config:cache
/www/server/php/83/bin/php artisan route:cache
/www/server/php/83/bin/php artisan view:cache
```

## 上线检查

- 首页 `/` 返回 `200 OK`
- 后台 `/admin/login` 返回 `200 OK`
- 未登录访问 `/admin` 应 `302` 跳转到 `/admin/login`
- `/storage/site/header-logo.webp` 返回 `200 OK`
- `/livewire-b0eb0382/livewire.min.js` 返回 `200 OK`
- Laravel 数据库连接返回 `DB_OK`
- 数据库连接到 `ruixi`
- 关键表 `users / sessions / cache / site_settings / page_sections` 存在
- `APP_DEBUG=false`
- `public/storage` 已链接

## 常见问题

### 页面 500

查看日志：

```bash
tail -n 100 storage/logs/laravel.log
```

常见原因：

- `.env` 数据库名、账号或密码错误
- 数据库未导入或表结构不是当前项目
- `sessions` 或 `cache` 表缺失
- `vendor/autoload.php` 不存在，说明 Composer 依赖未安装
- `storage` 或 `bootstrap/cache` 不可写

### 图片不显示

优先检查：

```bash
ls -la public/storage
curl -I http://ruixi.mbrsh.cn/storage/site/header-logo.webp
```

如果 `public/storage` 不存在，执行：

```bash
/www/server/php/83/bin/php artisan storage:link
```

### 后台点击登录无反应

检查 Livewire JS：

```bash
curl -I http://ruixi.mbrsh.cn/livewire-b0eb0382/livewire.min.js
```

如果不是 `200 OK`，复制 Livewire 静态文件到 `public/livewire-b0eb0382`。

### 登录后 403 Forbidden

说明账号密码已通过，但后台授权不通过。检查：

```bash
/www/server/php/83/bin/php artisan tinker --execute="$u=App\Models\User::where('email','admin')->first(); var_dump($u?->canAccessPanel(filament()->getPanel('admin')));"
```

应返回 `true`。

### 修改数据库配置后不生效

执行：

```bash
/www/server/php/83/bin/php artisan optimize:clear
```

再测试：

```bash
/www/server/php/83/bin/php artisan tinker --execute="DB::connection()->getPdo(); echo 'DB_OK';"
```
