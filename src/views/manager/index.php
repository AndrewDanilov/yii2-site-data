<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories andrewdanilov\sitedata\models\SiteDataCategory[] */

$this->title = 'Разделы настроек';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-data-index">
    <p style="margin-bottom:30px;">
        <?= Html::a('Редактировать параметры', ['/sitedata/data'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Редактировать разделы', ['/sitedata/category'], ['class' => 'btn btn-warning']) ?>
    </p>

    <div>
		<?php foreach ($categories as $category) { ?>
			<p><?= Html::a($category->name, ['/sitedata/manager/edit', 'category_id' => $category->id]) ?></p>
	    <?php } ?>
    </div>
</div>
