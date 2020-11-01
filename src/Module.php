<?php
namespace andrewdanilov\sitedata;

use Yii;

/**
 */
class Module extends \yii\base\Module
{
	public $access = ['@'];
	public $componentName = 'siteData';
	public $uploadBasePath = '@frontend/web';
	public $uploadPath = 'upload/sitedata';

	public function init()
	{
		$this->uploadPath = rtrim($this->uploadPath, DIRECTORY_SEPARATOR);
		Yii::$app->set($this->componentName, [
			'class' => 'andrewdanilov\sitedata\SiteDataComponent',
		]);
		$this->controllerMap['elfinder'] = [
			'class' => 'mihaildev\elfinder\Controller',
			'access' => $this->access,
			'roots' => [
				[
					'baseUrl' => '',
					'basePath' => $this->uploadBasePath,
					'path' => $this->uploadPath,
					'name' => 'SiteData Files',
				],
			],
		];
		parent::init();
	}
}