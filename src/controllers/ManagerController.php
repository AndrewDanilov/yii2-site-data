<?php
namespace andrewdanilov\sitedata\controllers;

use Yii;
use andrewdanilov\sitedata\models\SiteDataCategory;

/**
 * ManagerController
 */
class ManagerController extends BaseController
{
	/**
	 * @return mixed
	 */
    public function actionIndex()
    {
    	$categories = SiteDataCategory::find()->orderBy(['order' => SORT_ASC])->all();

	    return $this->render('index', [
		    'categories' => $categories,
	    ]);
    }

	/**
	 * @param int $category_id
	 * @return string|\yii\web\Response
	 */
    public function actionEdit($category_id)
    {
    	/* @var $category SiteDataCategory */
    	$category = SiteDataCategory::find()->where(['id' => $category_id])->one();

        $post = Yii::$app->request->post();
        if (isset($post['SiteData'])) {
		    $hasErrors = false;
		    foreach ($category->data as $data) {
			    if ($data->load($post['SiteData'][$data->key], '')) {
				    $data->prepareValue();
				    if (!$data->save()) {
					    $hasErrors = true;
				    }
			    }
		    }

		    if (!$hasErrors) {
			    Yii::$app->session->setFlash('success');
			    return $this->redirect(['edit', 'category_id' => $category_id]);
		    }
	    }

	    return $this->render('edit', [
		    'category' => $category,
	    ]);
    }
}
