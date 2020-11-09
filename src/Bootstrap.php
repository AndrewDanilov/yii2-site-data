<?php
namespace andrewdanilov\sitedata;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	/**
	 * @inheritdoc
	 */
	public function bootstrap($app)
	{
		$app->bootstrap[] = 'andrewdanilov\sitedata\Module';
	}
}