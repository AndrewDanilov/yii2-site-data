<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andrewdanilov\sitedata\models\SiteDataCategory */

if ($model->isNewRecord) {
	$this->title = 'Новый раздел настроек';
	$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['site-setting/index']];
	$this->params['breadcrumbs'][] = ['label' => 'Разделы настроек', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
} else {
	$this->title = 'Изменить раздел настроек: ' . $model->name;
	$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['site-setting/index']];
	$this->params['breadcrumbs'][] = ['label' => 'Разделы настроек', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $model->name;
}
?>
<div class="site-setting-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="site-data-category-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'order')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>
