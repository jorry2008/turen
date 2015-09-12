<?php

namespace backend\modules\cms\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;

use common\models\cms\Column;
use common\components\helpers\General;

/**
 * ColumnController implements the CRUD actions for Column model.
 */
class ColumnController extends Controller
{
    const MAX_PAGE_SIZE = 200;//设置为200个栏目，最大值，相当于all
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
    	return [
    		'uploadify' => [
    			'class' => 'backend\components\uploadify\UploadifyAction',
    		],
    		'ueditor' => [
    			'class' => 'backend\components\ueditor\UeditorAction',
    		]
    	];
    }
    
    /**
     * Lists all Column models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Column::find()->alive(),
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
		$keys = General::getModelsKeys($dataProvider->models, 'id');
        $dataProvider->setKeys($keys);
        
// 		fb($keys);
// 		fb($dataProvider->getKeys());
// 		fb($dataProvider->models);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Column model.
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
     * Creates a new Column model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=false)
    {
        $model = new Column();

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
     * Updates an existing Column model.
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
     * 
     * @throws NotFoundHttpException
     */
    public function actionOrder($id, $order)
    {
    	if(Yii::$app->getRequest()->isAjax) {
    		$model = $this->findModel($id);
    		$model->order = $order;
    		$model->save(false);
    		echo Json::encode(['status'=>0, 'msg'=>Yii::t('cms', 'Order is success!')]);
    	} else {
    		throw new NotFoundHttpException('404 This Is Ajax Page!');
    	}
    }

    /**
     * Finds the Column model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Column the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Column::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
