<?php
namespace andrewdanilov\sitedata;

use Yii;

/**
 */
class Module extends \yii\base\Module
{
	public $access = ['@'];
	public $user = 'user';
	public $componentName = 'siteData';
	public $basePath = '@frontend/web';
	public $uploadPath = 'upload';

	public function init()
	{
		$this->uploadPath = rtrim($this->uploadPath, DIRECTORY_SEPARATOR);
		Yii::$app->set($this->componentName, [
			'class' => 'andrewdanilov\sitedata\SiteDataComponent',
		]);
		$this->controllerMap['manager'] = [
			'class' => 'andrewdanilov\sitedata\controllers\ManagerController',
			'user' => $this->user,
			'access' => $this->access,
		];
		$this->controllerMap['data'] = [
			'class' => 'andrewdanilov\sitedata\controllers\DataController',
			'user' => $this->user,
			'access' => $this->access,
		];
		$this->controllerMap['category'] = [
			'class' => 'andrewdanilov\sitedata\controllers\CategoryController',
			'user' => $this->user,
			'access' => $this->access,
		];
		$this->controllerMap['elfinder'] = [
			'class' => 'mihaildev\elfinder\Controller',
			'access' => $this->access,
			'roots' => [
				[
					'baseUrl' => '',
					'basePath' => $this->basePath,
					'path' => $this->uploadPath . '/sitedata',
					'name' => 'SiteData Files',
				],
			],
		];
		parent::init();
	}
}