<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SiteSettingCategory */

$this->title = 'Новый раздел настроек';
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['site-setting/index']];
$this->params['breadcrumbs'][] = ['label' => 'Разделы настроек', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-setting-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
