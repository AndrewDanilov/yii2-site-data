Site Data
===================
Component for storing data values in various formats, for displaying them on site in any places (views, layouts, etc.)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-site-data "~1.0.0"
```

or add

```
"andrewdanilov/yii2-site-data": "~1.0.0"
```

to the `require` section of your `composer.json` file.


Then run db migrations, to create needed tables:

```
php yii migrate --migrationPath=@andrewdanilov/sitedata/migrations
```

Do not forget to run migrations after extension updates too.


Usage
-----

Configure _module_ settings in your `backend` main config:

```php
$config = [
	// ...
	'modules' => [
		// ...
		'sitedata' => [
			'class' => 'andrewdanilov\sitedata\Module',
			'access' => ['admin'], // access role for module controllers, optional, default is ['@']
			'uploadBasePath' => '@frontend/web', // optional, default is '@frontend/web'
			'uploadPath' => 'upload/sitedata', // optional, default is 'upload/sitedata'
		],
	],
];
```

Here `access` option allows restricting access to defined roles. Options `basePath` and `uploadPath` defines a path where the different type of images or files will be stored.
Module allows you to create, modify and manage various site settings.

Configure _component_ settings in your `frontend` main config:

```php
$config = [
	// ...
	'components' => [
		// ...
		'siteData' => [
			'class' => 'andrewdanilov\sitedata\components\SiteData',
		],
	],
];
```

Component generally allows you to get site settings values. You can print them in views or use in contorollers and other places.
To use needed value in your view, for example, use:

```php
$this->title = Yii::$app->siteData->get('seo_title', 'Default seo title');
```

Second param is optional and defines default value if key does not exist.

You can also change values. Changes a permanent and stores into a database:

```php
$this->title = Yii::$app->siteData->set('seo_title', 'New seo title');
```

The `siteData` is a component name, configured in `component` section above.

Backend links to manage site data and categories:

```php
// list of links for managing values of each category all in one page
$categoryListUrl = Yii::$app->urlManager->createUrl(['/sitedata/manager']);
// manager of all values of category in one page
$categoryDataManagerUrl = Yii::$app->urlManager->createUrl(['/sitedata/manager/edit', 'category_id' => 123]);

// grid for adding/editing/removing data items
$dataGridUrl = Yii::$app->urlManager->createUrl(['/sitedata/data']);
// grid for adding/editing/removing data categories
$categoryGridUrl = Yii::$app->urlManager->createUrl(['/sitedata/category']);
```

Backend menu items:

```php
$sitedata_menu_items = [
    ['label' => 'Site Data'],
	['label' => 'Site settings', 'url' => ['/sitedata/manager'], 'icon' => 'cog'],
];

echo \yii\widgets\Menu::widget(['items' => $sitedata_menu_items]);
```