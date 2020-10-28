<?php
namespace andrewdanilov\sitedata\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class BackendController extends Controller
{
	public $access = ['@'];
	public $user = 'user';

	public function behaviors()
	{
		return [
			'access' => [
				'user' => $this->user,
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