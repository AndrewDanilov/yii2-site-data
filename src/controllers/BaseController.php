<?php
namespace andrewdanilov\sitedata\controllers;

use andrewdanilov\sitedata\Module;
use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{
	public $access;

	public function init()
	{
		if (empty($this->access)) {
			$module = Module::getInstance();
			if (isset($module->access)) {
				$this->access = $module->access;
			} else {
				$this->access = ['@'];
			}
		}
		parent::init();
	}

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => $this->access,
					],
				],
			],
		];
	}
}