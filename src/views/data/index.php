<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use andrewdanilov\sitedata\models\SiteData;
use andrewdanilov\sitedata\models\SiteDataCategory;

/* @var $this yii\web\View */
/* @var $searchModel andrewdanilov\sitedata\models\SiteDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-data-index">

    <p>
        <?= Html::a('Новый параметр', ['update'], ['class' => 'btn btn-success']) ?>
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
		        'value' => function(SiteData $model) {
			        if ($model->type == SiteData::VALUE_TYPE_BOOLEAN) {
				        return Yii::$app->formatter->asBoolean($model->value);
			        } elseif ($model->type == SiteData::VALUE_TYPE_TEXT ||
				        $model->type == SiteData::VALUE_TYPE_REACHTEXT) {
				        $v = StringHelper::truncateWords($model->value, 20, '...');
				        return preg_replace("/[\n\r]+/", "\n", $v);
			        } else {
				        return $model->value;
			        }
		        },
	        ],
            [
            	'attribute' => 'type',
	            'value' => function(SiteData $model) {
    	            return ArrayHelper::getValue($model::getTypeList(), $model->type);
	            },
	            'filter' => $searchModel::getTypeList(),
            ],

	        [
		        'class' => 'yii\grid\ActionColumn',
		        'template' => '{update}&nbsp;&nbsp;&nbsp;&nbsp;{delete}',
		        'contentOptions' => ['style' => 'white-space: nowrap;'],
	        ],
        ],
    ]); ?>
</div>
