<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\SiteSetting;
use common\models\SiteSettingCategory;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiteSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый параметр', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Разделы настроек', ['site-setting-category/index'], ['class' => 'btn btn-warning']) ?>
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
		        'filter' => SiteSettingCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
	        ],
            'key',
            'name',
	        [
		        'attribute' => 'value',
		        'format' => 'raw',
		        'value' => function(SiteSetting $model) {
			        if ($model->type == SiteSetting::VALUE_TYPE_BOOLEAN) {
				        return Yii::$app->formatter->asBoolean($model->value);
			        } elseif ($model->type == SiteSetting::VALUE_TYPE_TEXT ||
				        $model->type == SiteSetting::VALUE_TYPE_REACHTEXT) {
				        $v = StringHelper::truncateWords($model->value, 20, '...');
				        return preg_replace("/[\n\r]+/", "\n", $v);
			        } else {
				        return $model->value;
			        }
		        },
	        ],
            [
            	'attribute' => 'type',
	            'value' => function(SiteSetting $model) {
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
