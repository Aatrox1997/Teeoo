## Hello Teeoo

> 幸有你来,不悔初见。

------------

### 新 博 客,自 豪 的 采 用 了 自 己 开 发 的 博 客！ 
	

### 食用方法

- 先进行克隆
    >   git clone https://github.com/iatw/Teeoo.git
- 解决依赖
	>	composer install
- 建立.env文件
	>	cp .env.example .env
- 生成key
	>	php artisan key:generate
- 在env文件中设置以下信息
  - #### 主题和程序版本号
    - APP_THEME=snow
    - Edition=v1.0
    
  - #### 数据库配置信息
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=teeoo
    - DB_USERNAME=root
    - DB_PASSWORD=
    
  - #### 邮件配置信息
    - MAIL_DRIVER=smtp
    - MAIL_HOST=smtp.163.com
    - MAIL_PORT=465
    - MAIL_USERNAME=15082747556@163.com
    - MAIL_PASSWORD=15082747556a
    - MAIL_ENCRYPTION=ssl
    - MAIL_FROM_ADDRESS=15082747556@163.com
    - MAIL_FROM_NAME=Teeoo
    
  - #### 站点配置信息
    - SITE_KEY=这里填写你博客的keyword
    - SITE_HOST = 这里天下你博客的域名
    - SITE_NAME= 这里填写你博客名字
    - SITE_custom= 这里填写你自定义上传文件的格式
    - SITE_address= 这里填写你博客的地址
    - picture= gif,jpg,jpeg,png,tiff,bmp
    - SITE_archives=txt,doc,docx,xls,xlsx,ppt,pptx,zip,rar,pdf
    - SITE_Multi-Media=mp3,wmv,wma,rmvb,rm,avi,flv
    - SITE_checkbox = 1
    - SITE_describe= 这里填写你博客的描述
    - SITE_Bottomcode= 底部代码
    - Be_limited_to_ip= 禁止访问博客的ip使用,分开
    - Number_of_logins= 最大登录失败次数

- 执行 migrate 创建数据库
	>	php artisan migrate
- 执行 seeder 创建默认管理员账号
	>	php artisan db:


#### Web 服务器配置

###### Apache

框架中自带的 public/.htaccess 文件支持隐藏 URL 中的 index.php，如过你的 Laravel 应用使用 Apache 作为服务器，需要先确保 Apache 启用了mod_rewrite 模块以支持 .htaccess 解析。

如果 Laravel 自带的 .htaccess 文件不起作用，试试将其中内容做如下替换：

    Options +FollowSymLinks
    RewriteEngine On
    
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

###### Nginx

如果你使用的是 Nginx，使用如下站点配置指令就可以支持 URL 美化：

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
	
当然，如果使用 Homestead 或 Valet 的话，以上配置已经为你配置好，无需额外操作。

> 到了这里如果不出意外的话程序应该能正常跑起来了 ,当然你也可以使用laravel内置的web服务器:`php artisan serve`来运行程序,本地推荐这样做,服务器上还是推荐Nginx


一.后端
- 	环境:`Nginx+ PHP + MySQL`
- 	PHP框架:`Laravel5.6`
- 	~~文件存储系统:七牛云存储~~
- 	PHP包管理:`Composer`
- 	版本控制:`GIT`

所用到的`composer`包:
```json
{
    "开发三件套":{
        "barryvdh":{
            "debugbar":"laravel-debugbar",
            "ide-helper":"laravel-ide-helper",
            "factory-helper":"laravel-test-factory-helper"
        },
        "Seo":"artesaos/seotools",
        "Themes":"facuz/laravel-themes",
        "Xss":"voku/anti-xss",
        "Gravatar":"thomaswelton/laravel-gravatar",
        "Sitemap":"spatie/laravel-sitemap",
        "Pjax":"spatie/laravel-pjax",
        "Tree":"jiaxincui/closure-table"
    }
}
```

二.前端

> 前端默认使用了**@往秋不往冬月**开发的typecho主题,如果你熟悉PHP你完全可以定制你的主题

### 开发日志
- Teeoo 2018-04-13
	- 	Teeoo v1.0 发布
- Teeoo 2018-04-14
	- 	完成Tag,文章等等CURD
	- 	完成评论邮件通知
	- 	修改iconfont
	- 	完成基本设置Mysql版本需要大于等于5.7
	- 	修复若干BUG
- Teeoo 2018-04-16
	- 	更新个人设置
	- 	修改文章修改BUG
	- 	一些配置放入.env中
- Teeoo 2018-04-18
	-	加入SEO
	-	加入Sitemap
- Teeoo 2018-04-20
	-	更新READNE.md
- Teeoo 2018-04-21
   	-	移植**@贫困的蚊子**的Candy-Rebirth主题
       

