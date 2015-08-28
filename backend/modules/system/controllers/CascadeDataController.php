<?php

namespace backend\modules\system\controllers;

use Yii;
use common\models\system\CascadeData;
use common\models\system\CascadeDataSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * CascadeDataController implements the CRUD actions for CascadeData model.
 */
class CascadeDataController extends Controller
{
    /**
     * Lists all CascadeData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CascadeDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CascadeData model.
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
     * Creates a new CascadeData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CascadeData();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $params = Yii::$app->getRequest()->queryParams;
            if(!empty($params['parent_id'])) {
                $parentModel = $this->findModel($params['parent_id']);
            }
            
            return $this->render('create', [
                'model' => $model,
                'parentModel' => isset($parentModel)?$parentModel:'',
            ]);
        }
    }

    /**
     * Updates an existing CascadeData model.
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
     * Deletes an existing CascadeData model.
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
     * @return Ambigous <string, string>
     */
    public function actionDemo()
    {
        return $this->render('demo', [
            //'model' => $model,
        ]);
    }
    
    /**
     * 以ajax的方式返回搜索到的数据信息，
     * 并返回定制后的select数据源
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionGetCascadeParentData()
    {
        if(Yii::$app->getRequest()->isAjax) {
            $searchModel = new CascadeDataSearch();
            $dataProvider = $searchModel->searchForAjax(Yii::$app->request->queryParams);
    
            $models = $dataProvider->getModels();
            $data = [];
            foreach (ArrayHelper::map($models, 'id', 'name') as $key=>$value) {
                $data[] = ['id'=>$key, 'text'=>$value];
            }
            $data[] = ['id'=>0, 'text'=>Yii::t('system', 'Parent Id Is Zero')];//创建层级为0的情况
            echo Json::encode(['status'=>0, 'msg'=>$data]);
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }
    
    /**
     * 以ajax的方式返回搜索到的数据信息，联动查询功能
     * 并返回定制后的select数据源
     * @return int $level
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionGetCascadeData($level, $parent_id)
    {
        if(Yii::$app->getRequest()->isAjax) {
            if($parent_id === '') {
                echo Json::encode(['status'=>1, 'msg'=>Yii::t('system', 'Please choose the parent item!')]);
                Yii::$app->end();
            }
            
            $models = (new CascadeData)->findDate($level, $parent_id);
            $data = [];
            foreach (ArrayHelper::map($models, 'id', 'name') as $key=>$value) {
                $data[] = ['id'=>$key, 'text'=>$value];
            }
            
            echo Json::encode(['status'=>0, 'msg'=>$data]);
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }
    


    /**
     * Finds the CascadeData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CascadeData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CascadeData::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
