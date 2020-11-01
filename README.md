Site Data
===================
Component for storing data values in various formats, for displaying them on site in any places (views, layouts, etc.)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-site-data "*"
```

or add

```
"andrewdanilov/yii2-site-data": "*"
```

to the `require` section of your `composer.json` file.


Then run db migrations, to create needed tables:

```
php yii migrate --migrationPath=@andrewdanilov/sitedata/migrations
```

Do not forget to run migrations after extension updates too.


Usage
-----

_Extension is in testing. Do not use it!_

Configure settings in your `common` config:

```php
$config = [
	// ...
	'modules' => [
		// ...
		'sitedata' => [
			'class' => 'andrewdanilov\sitedata\Module',
			'componentName' => 'siteData', // optional, default is 'siteData'
			'access' => ['admin'], // access role for module controllers, optional, default is ['@']
			'uploadBasePath' => '@frontend/web', // optional, default is '@frontend/web'
			'uploadPath' => 'upload/sitedata', // optional, default is 'upload/sitedata'
		],
	],
];
```

Here `access` option allows restricting access to defined roles. Options `basePath` and `uploadPath` defines a path where the different type of images or files will be stored.


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

To display needed value in your view, for example, use:

```php
$this->title = Yii::$app->siteData->get('seo_title', 'Default seo title');
```

where `siteData` is a component name, configured in `componentName` property of `sitedata` module. Second param is optional
and defines default value if key does not exist.
