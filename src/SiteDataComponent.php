<?php
namespace andrewdanilov\sitedata;

use yii\base\Component;
use andrewdanilov\sitedata\models\SiteData;

class SiteDataComponent extends Component
{
	public $_settings = [];

	public function has($key)
	{
		if (!isset($this->_settings[$key])) {
			return SiteData::hasValue($key);
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
			$this->_settings[$key] = SiteData::getValue($key, $defaultValue);
		}
		return $this->_settings[$key];
	}

	public function set($key, $value)
	{
		SiteData::setValue($key, $value);
		return SiteData::getValue($key);
	}
}