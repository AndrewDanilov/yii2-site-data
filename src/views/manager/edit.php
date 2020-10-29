<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use andrewdanilov\InputImages\InputImages;
use andrewdanilov\ckeditor\CKEditor;
use andrewdanilov\helpers\CKEditorHelper;

/* @var $this yii\web\View */
/* @var $category andrewdanilov\sitedata\models\SiteDataCategory */

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;
?>
<div class="site-data-edit">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="site-data-form">

		<?php $form = ActiveForm::begin(); ?>

		<?php foreach ($category->data as $data) { ?>

			<?php if ($data->type == $data::VALUE_TYPE_REACHTEXT) { ?>
				<?= $form->field($data, 'value')->widget(CKEditor::class, [
					'editorOptions' => ElFinder::ckeditorOptions('elfinder', CKEditorHelper::defaultOptions()),
				]) ?>
			<?php } elseif ($data->type == $data::VALUE_TYPE_TEXT) { ?>
				<?= $form->field($data, 'value')->textarea(['rows' => 6]) ?>
			<?php } elseif ($data->type == $data::VALUE_TYPE_BOOLEAN) { ?>
				<?= $form->field($data, 'value')->dropDownList(['0' => 'Нет', '1' => 'Да']) ?>
			<?php } elseif ($data->type == $data::VALUE_TYPE_FILE) { ?>
				<?= $form->field($data, 'value')->widget(InputFile::class, [
					'language'      => 'ru',
					'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
					'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
					'options'       => ['class' => 'form-control'],
					'buttonOptions' => ['class' => 'btn btn-default'],
					'multiple'      => false,      // возможность выбора нескольких файлов
				]) ?>
			<?php } elseif ($data->type == $data::VALUE_TYPE_IMAGE) { ?>
				<?= $form->field($data, 'value')->widget(InputImages::class) ?>
			<?php } else { ?>
				<?= $form->field($data, 'value')->textInput(['maxlength' => true]) ?>
			<?php } ?>

		<?php } ?>

		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>

</div>
