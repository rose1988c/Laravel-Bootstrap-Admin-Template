## Laravel-Bootstrap-Admin-Template

This is an Manage System for Laravel with theme [bracket](http://themepixels.com/demo/webpage/bracket/)

如果不喜欢该主题，请自行变更[bootswatch](http://bootswatch.com/)

## 主要实现

* 登录、注册

* 菜单管理

* 角色管理

### 预览

![http://www.webpagescreenshot.info/i3/53b272f6a6ad55-76462999](http://www.webpagescreenshot.info/i3/53b272f6a6ad55-76462999)

### Installation App

该版本是全部文件打包形式，下个版本将以`package`的形式

因composer缓慢，已增加`vendor`目录，也可以自行`composer update`

没有用迁移工具，请自行导入数据库 `sql => app\config\schema\mcc_cluster.sql`


	`composer.json`

	{
		"require": {
			"laravel/framework": "4.1.*",
			"barryvdh/laravel-ide-helper": "1.*",
			"bllim/datatables": "*",
	        "way/generators": "2.*",
	        "guzzlehttp/guzzle": "~4.0"
		}
	}


### update

自身需求已经满足，应该很长段时间不会更新了，如有个别需求欢迎提出。。<a href="mailto:rose1988.c@gmail.com">rose1988c</a>