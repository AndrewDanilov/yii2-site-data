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

	public function init()
	{
		Yii::$app->set($this->componentName, [
			'class' => 'andrewdanilov\sitedata\SiteDataComponent',
		]);
		$this->controllerMap['data'] = [
			'class' => 'andrewdanilov\sitedata\controllers\SiteDataController',
			'user' => $this->user,
			'access' => $this->access,
		];
		$this->controllerMap['category'] = [
			'class' => 'andrewdanilov\sitedata\controllers\SiteDataCategoryController',
			'user' => $this->user,
			'access' => $this->access,
		];
		parent::init();
	}
}