<?php

namespace backend\modules\cms\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\cms\CmsClass;
use common\components\helpers\General;

/**
 * CmsClassController implements the CRUD actions for CmsClass model.
 */
class CmsClassController extends Controller
{
    const MAX_PAGE_SIZE = 200;//设置为200个栏目，最大值，相当于all
    /**
     * Lists all CmsClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsClass::find(),
            'pagination' => [
                'pageSize' => static::MAX_PAGE_SIZE,
            ],
            'sort' => [
                'defaultOrder' => [
                    'order' => SORT_ASC
                ],
            ],
        ]);
        
        //递归处理
        $dataProvider->models = General::recursiveObj($dataProvider->models, 0, 0, '' ,'<span class="bank"></span>', false);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsClass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=false)
    {
        $model = new CmsClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'id' => $id,
            ]);
        }
    }

    /**
     * Updates an existing CmsClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * 切换栏目状态
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionSwitchStauts($id)
    {
    	$model = $this->findModel($id);
    	$model->status = $model->status?0:1;//取反
    	$model->save(false);
    	return $this->redirect(['index']);
    }

    /**
     * Finds the CmsClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
