<?php
namespace andrewdanilov\sitedata\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use andrewdanilov\sitedata\models\SiteData;
use andrewdanilov\sitedata\models\SiteDataSearch;

/**
 * DataController implements the CRUD actions for SiteData model.
 */
class DataController extends BaseController
{
    /**
     * Lists all SiteData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing SiteData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int|null $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id=null)
    {
    	if ($id) {
	        $model = $this->findModel($id);
	    } else {
		    $model = new SiteData();
	    }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SiteData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SiteData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return SiteData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiteData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
