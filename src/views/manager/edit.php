<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use andrewdanilov\InputImages\InputImages;
use andrewdanilov\ckeditor\CKEditor;
use andrewdanilov\helpers\CKEditorHelper;
use andrewdanilov\sitedata\models\SiteData;

/* @var $this yii\web\View */
/* @var $category andrewdanilov\sitedata\models\SiteDataCategory */

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;
?>
<div class="site-data-edit">

	<?php $form = ActiveForm::begin(); ?>

	<?php foreach ($category->data as $data) { ?>

		<?php
		switch ($data->type) {
			case SiteData::VALUE_TYPE_REACHTEXT:
				echo $form->field($data, '[' . $data->key . ']value')->widget(CKEditor::class, [
					'editorOptions' => ElFinder::ckeditorOptions('elfinder', CKEditorHelper::defaultOptions()),
				])->label($data->name);
				break;
			case SiteData::VALUE_TYPE_TEXT:
				echo $form->field($data, '[' . $data->key . ']value')->textarea(['rows' => 6])->label($data->name);
				break;
			case SiteData::VALUE_TYPE_BOOLEAN:
				echo $form->field($data, '[' . $data->key . ']value')->dropDownList(['0' => 'Нет', '1' => 'Да'])->label($data->name);
				break;
			case SiteData::VALUE_TYPE_FILE:
				echo $form->field($data, '[' . $data->key . ']value')->widget(InputFile::class, [
					'language'      => 'ru',
					'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
					'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
					'options'       => ['class' => 'form-control'],
					'buttonOptions' => ['class' => 'btn btn-default'],
					'multiple'      => false,      // возможность выбора нескольких файлов
				])->label($data->name);
				break;
			case SiteData::VALUE_TYPE_IMAGE:
				echo $form->field($data, '[' . $data->key . ']value')->widget(InputImages::class)->label($data->name);
				break;
			default:
				echo $form->field($data, '[' . $data->key . ']value')->textInput(['maxlength' => true])->label($data->name);
		}
		?>

	<?php } ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
