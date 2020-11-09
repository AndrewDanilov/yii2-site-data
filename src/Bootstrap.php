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
		$app_modules = \Yii::$app->modules;
		// bootstraps all registered sitedata modules
		foreach ($app_modules as $module_id => $module) {
			if (static::getModuleClassName($module) == 'andrewdanilov\sitedata\Module') {
				$app->bootstrap[] = $module_id;
			}
		}
	}

	public static function getModuleClassName($module)
	{
		if (is_object($module)) {
			return $module->class;
		}

		if (is_string($module)) {
			return $module;
		}

		if (is_array($module)) {
			if (isset($module['__class'])) {
				return $module['__class'];
			}

			if (isset($module['class'])) {
				return $module['class'];
			}
		}

		return null;
	}
}