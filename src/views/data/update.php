<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use andrewdanilov\InputImages\InputImages;
use andrewdanilov\ckeditor\CKEditor;
use andrewdanilov\helpers\CKEditorHelper;
use andrewdanilov\sitedata\models\SiteDataCategory;

/* @var $this yii\web\View */
/* @var $model andrewdanilov\sitedata\models\SiteData */

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

	<?= $form->field($model, 'category_id')->dropDownList(SiteDataCategory::find()->select(['name', 'id'])->orderBy('order')->indexBy('id')->column()) ?>

	<?= $form->field($model, 'key')->textInput(['maxlength' => true])->label('Параметр (только латиница)') ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php if ($model->type == $model::VALUE_TYPE_REACHTEXT) { ?>
		<?= $form->field($model, 'value')->widget(CKEditor::class, [
			'editorOptions' => ElFinder::ckeditorOptions('elfinder', CKEditorHelper::defaultOptions()),
		]) ?>
	<?php } elseif ($model->type == $model::VALUE_TYPE_TEXT) { ?>
		<?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
	<?php } elseif ($model->type == $model::VALUE_TYPE_BOOLEAN) { ?>
		<?= $form->field($model, 'value')->dropDownList(['0' => 'Нет', '1' => 'Да']) ?>
	<?php } elseif ($model->type == $model::VALUE_TYPE_FILE) { ?>
		<?= $form->field($model, 'value')->widget(InputFile::class, [
			'language'      => 'ru',
			'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
			'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
			'options'       => ['class' => 'form-control'],
			'buttonOptions' => ['class' => 'btn btn-default'],
			'multiple'      => false,      // возможность выбора нескольких файлов
		]) ?>
	<?php } elseif ($model->type == $model::VALUE_TYPE_IMAGE) { ?>
		<?= $form->field($model, 'value')->widget(InputImages::class) ?>
	<?php } else { ?>
		<?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
	<?php } ?>

	<?= $form->field($model, 'type')->dropDownList($model->getTypeList()) ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
