# Ruixi 项目说明

## 项目范围

- 本地项目根目录：`D:\PHPstudy\WWW\ruixi.com`
- 线上项目根目录：`/www/wwwroot/ruixi.mbrsh.cn`
- 线上网址：`http://ruixi.mbrsh.cn/`
- 本地访问：`http://ruixi.com/`
- 框架：Laravel + Filament

## 线上服务器

- 服务器 IP：`47.98.20.89`
- SSH 用户：`root`
- 后续服务器操作只允许在项目根目录 `/www/wwwroot/ruixi.mbrsh.cn` 内进行，除非用户明确授权。
- 不要修改服务器系统级配置、其它站点目录、宝塔面板配置或其它数据库。
- 服务器密码不要写入仓库文件、日志、文档或提交记录；如需连接，使用用户在当前对话中提供的凭据。

## 数据库边界

- 线上数据库名：`ruixi`
- 线上数据库用户：`ruixi`
- 后续数据库操作仅限 `ruixi` 数据库。
- 不要操作其它数据库，不要创建、删除或修改其它站点的数据。
- 数据库密码不要写入仓库文件、日志、文档或提交记录。

## 部署约定

- 上传前先在远端项目目录内备份被覆盖文件，例如：
  `/www/wwwroot/ruixi.mbrsh.cn/backups/deploy-YYYYMMDD-HHMMSS`
- 上传文件后恢复属主为 `www:www`。
- Laravel 视图或配置相关文件变更后，执行：
  `php artisan view:clear`
  `php artisan optimize:clear`
- 验证线上页面和静态资源：
  `http://ruixi.mbrsh.cn/`
  `http://ruixi.mbrsh.cn/static/css/main.css`
  `http://ruixi.mbrsh.cn/ceo.html`

## 当前重要变更记录

- 主题色已改为白底导航 + 紫金强调方案，避免导航 LOGO 与背景重叠。
- CEO 页面大图已按 `https://www.optimax2u.com/cn/ceo.php` 参考页方式处理：默认 `<div class="hero sandy"></div>`，由 CSS 控制 `ceo.webp` / `ceo@2x.webp`。
- 线上最近一次部署备份目录：
  `/www/wwwroot/ruixi.mbrsh.cn/backups/deploy-20260629-224146`
