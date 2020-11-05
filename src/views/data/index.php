<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use andrewdanilov\sitedata\models\SiteData;
use andrewdanilov\sitedata\models\SiteDataSearch;
use andrewdanilov\sitedata\models\SiteDataCategory;
use andrewdanilov\behaviors\ValueTypeBehavior;

/* @var $this yii\web\View */
/* @var $searchModel SiteDataSearch|ValueTypeBehavior */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-data-index">

    <p>
        <?= Html::a('Новый параметр', ['/sitedata/data/update'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Разделы настроек', ['/sitedata/category'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
	        [
		        'attribute' => 'id',
		        'headerOptions' => ['width' => 100],
	        ],
	        [
		        'attribute' => 'category_id',
		        'value' => 'category.name',
		        'filter' => SiteDataCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
	        ],
            'key',
            'name',
	        [
		        'attribute' => 'value',
		        'format' => 'raw',
		        'value' => function($model) {
			        /* @var $model Sitedata|ValueTypeBehavior */
			        return $model->prettifyValue(null, 20);
		        },
	        ],
            [
            	'attribute' => 'type',
	            'value' => function($model) {
    	            /* @var $model Sitedata */
    	            return ArrayHelper::getValue(ValueTypeBehavior::getTypeList(), $model->type);
	            },
	            'filter' => ValueTypeBehavior::getTypeList(),
            ],

	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
		        'contentOptions' => ['style' => 'white-space: nowrap;'],
	        ],
        ],
    ]); ?>
</div>
