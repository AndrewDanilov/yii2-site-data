<?php
namespace andrewdanilov\sitedata\components;

use yii\base\Component;
use andrewdanilov\sitedata\models\SiteData as SiteDataModel;

class SiteData extends Component
{
	public $_settings = [];

	public function has($key)
	{
		if (!isset($this->_settings[$key])) {
			return SiteDataModel::hasValue($key);
		}
		return true;
	}

	public function is($key, $value)
	{
		return $this->get($key) == $value;
	}

	public function get($key, $defaultValue=null)
	{
		if (!isset($this->_settings[$key])) {
			$this->_settings[$key] = SiteDataModel::getValue($key, $defaultValue);
		}
		return $this->_settings[$key];
	}

	public function set($key, $value)
	{
		SiteDataModel::setValue($key, $value);
		return SiteDataModel::getValue($key);
	}
}