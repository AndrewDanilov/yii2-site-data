<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use andrewdanilov\InputImages\InputImages;
use andrewdanilov\ckeditor\CKEditor;
use andrewdanilov\helpers\CKEditorHelper;
use andrewdanilov\sitedata\models\SiteData;
use andrewdanilov\sitedata\models\SiteDataCategory;
use andrewdanilov\behaviors\ValueTypeBehavior;

/* @var $this yii\web\View */
/* @var $model SiteData|ValueTypeBehavior */

if ($model->isNewRecord) {
	$this->title = 'Новый параметр';
	$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
} else {
	$this->title = 'Изменить параметр: ' . $model->key;
	$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $model->key;
}
?>
<div class="site-data-update">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'category_id')->dropDownList(SiteDataCategory::getCategoriesList()) ?>

	<?= $form->field($model, 'key')->textInput(['maxlength' => true])->label('Параметр (только латиница)') ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $model->formField($form, 'value', 'Значение') ?>

	<?= $form->field($model, 'type')->dropDownList(ValueTypeBehavior::getTypeList()) ?>

	<?= $form->field($model, 'order')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
