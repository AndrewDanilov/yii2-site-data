<?php
namespace andrewdanilov\sitedata\assets;

use yii\web\AssetBundle;

class SiteDataAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/sitedata/web';
	public $css = [
		'css/sitedata.css',
	];
	public $js = [
	];
	public $depends = [
	];
}