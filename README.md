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


Usage
-----

_Extension is in testing. Do not use it!_

Configure settings in your `common/config/main.php`:

```php
$config = [
	// ...
	'modules' => [
		// ...
		'siteData' => [
			'class' => 'andrewdanilov\sitedata\Module',
			'componentName' => 'siteData', // optional, default is 'siteData'
			'user' => 'user', // optional, default is 'user'
			'access' => ['admin'], // optional, default is ['@']
		],
	],
];
```

Display needed value in your view, for example:

```php
$this->title = Yii::$app->siteData->get('seo_title', 'Default seo title');
```

Where `siteData` is a component name, setted in `componentName` property of siteData module.
