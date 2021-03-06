<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;

/* @var $this yii\web\View */
/* @var $category andrewdanilov\sitedata\models\SiteDataCategory */

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;
?>
<div class="site-data-edit">

	<?php $form = ActiveForm::begin(); ?>

	<?php foreach ($category->data as $data) { ?>

		<?= $data->formField($form, '[' . $data->key . ']value', $data->name) ?>

	<?php } ?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
