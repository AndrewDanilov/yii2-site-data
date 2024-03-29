<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel andrewdanilov\sitedata\models\SiteDataCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разделы настроек';
$this->params['breadcrumbs'][] = ['label' => 'Настройки сайта', 'url' => ['/sitedata/category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-setting-category-index">
    <p style="margin-bottom:30px;">
        <?= Html::a('Новый раздел', ['/sitedata/category/update'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать параметры', ['/sitedata/data'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
	        [
		        'attribute' => 'id',
		        'headerOptions' => ['width' => 100],
	        ],
            'name',
            'order',

	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
		        'contentOptions' => ['style' => 'white-space: nowrap;'],
	        ],
        ],
    ]); ?>
</div>
