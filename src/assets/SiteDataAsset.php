<?php
namespace andrewdanilov\src\assets;

use yii\web\AssetBundle;

class SiteDataAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/assets/web';
	public $css = [
		'css/sitedata.css',
	];
	public $js = [
	];
	public $depends = [
	];
}