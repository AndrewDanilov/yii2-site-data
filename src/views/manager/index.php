<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories string[] categories names indexed by id */

$this->title = 'Разделы настроек';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-data-index">
    <p style="margin-bottom:30px;">
        <?= Html::a('Редактировать параметры', ['/sitedata/data'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Редактировать разделы', ['/sitedata/category'], ['class' => 'btn btn-warning']) ?>
    </p>

    <div>
		<?php foreach ($categories as $category_id => $category_name) { ?>
			<p><?= Html::a($category_name, ['/sitedata/manager/edit', 'category_id' => $category_id]) ?></p>
	    <?php } ?>
    </div>
</div>
