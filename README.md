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

Configure settings in your `common/config/main.php`:

```php
$config = [
	// ...
	'modules' => [
		// ...
		'sitedata' => [
			'class' => 'andrewdanilov\sitedata\Module',
			'componentName' => 'siteData', // optional, default is 'siteData'
			'user' => 'user', // optional, default is 'user'
			'access' => ['admin'], // optional, default is ['@']
		],
	],
];
```

Backend links to manage values and categories:

```php
$valuesMangerUrl = Yii::$app->urlManager->createUrl(['/sitedata/data']);
$categoriesMangerUrl = Yii::$app->urlManager->createUrl(['/sitedata/category']);
```

To display needed value in your view, for example, use:

```php
$this->title = Yii::$app->siteData->get('seo_title', 'Default seo title');
```

where `siteData` is a component name, setted in `componentName` property of `sitedata` module.
