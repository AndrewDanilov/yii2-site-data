<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\SiteSettingCategory;
use mihaildev\elfinder\InputFile;

/* @var $this yii\web\View */
/* @var $model common\models\SiteSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-setting-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'category_id')->dropDownList(SiteSettingCategory::find()->select(['name', 'id'])->orderBy('order')->indexBy('id')->column()) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true])->label('Параметр (только латиница)') ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php if ($model->type == $model::VALUE_TYPE_REACHTEXT) { ?>
		<?= $form->field($model, 'value')->widget(CKEditor::class, [
			'editorOptions' => [
				'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			],
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
		<?= $form->field($model, 'value')->widget(InputFile::class, [
			'language'      => 'ru',
			'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
			'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
			'template'      => '<div>' . Html::img($model->value, ['width' => '300', 'class' => 'preview']) . '</div><div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
			'options'       => ['class' => 'form-control'],
			'buttonOptions' => ['class' => 'btn btn-default'],
			'multiple'      => false,      // возможность выбора нескольких файлов
		]) ?>
		<?php $this->registerJs("$('#sitesetting-value').on('change', function() { $(this).parents('.form-group').find('img.preview').attr('src', $(this).val()); });"); ?>
	<?php } else { ?>
		<?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
	<?php } ?>

    <?= $form->field($model, 'type')->dropDownList($model->getTypeList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
