<?php

use andrewdanilov\behaviors\ValueTypeBehavior;
use andrewdanilov\sitedata\models\SiteData;
use andrewdanilov\sitedata\assets\SiteDataAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $category andrewdanilov\sitedata\models\SiteDataCategory */

SiteDataAsset::register($this);

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;
?>
<div class="site-data-edit">
	<p style="margin-bottom:30px;">
		<?= Html::a('Редактировать параметры', ['/sitedata/data'], ['class' => 'btn btn-warning']) ?>
		<?= Html::a('Редактировать разделы', ['/sitedata/category'], ['class' => 'btn btn-warning']) ?>
	</p>

	<?php $form = ActiveForm::begin(); ?>

	<?php foreach ($category->data as $data) { ?>

		<?php /* @var SiteData|ValueTypeBehavior $data */ ?>
		<?= $data->formField($form, '[' . $data->key . ']value', $data->name)->hint($data->key) ?>

	<?php } ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
