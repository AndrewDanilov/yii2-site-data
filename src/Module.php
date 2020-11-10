<?php
namespace andrewdanilov\sitedata;

/**
 */
class Module extends \yii\base\Module
{
	public $access = ['@'];
	public $uploadBasePath = '@frontend/web';
	public $uploadPath = 'upload/sitedata';

	public function init()
	{
		$this->uploadPath = trim($this->uploadPath, DIRECTORY_SEPARATOR);
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