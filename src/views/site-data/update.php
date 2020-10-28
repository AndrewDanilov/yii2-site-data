<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteSetting */

$this->title = 'Изменить параметр: ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->key;
?>
<div class="site-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
