<?php

namespace backend\modules\extend\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use common\models\extend\Nav;
use common\components\helpers\General;
use backend\components\Controller;


/**
 * NavController implements the CRUD actions for Nav model.
 */
class NavController extends Controller
{
	const MAX_PAGE_SIZE = 200;//设置为200个栏目，最大值，相当于all
	
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'switch-status' => [
				'class' => 'backend\components\SwitchAction',
				'className' => Nav::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'status',
// 				'route' => '/extend/nav/index',
			],
			'delete' => [
				'class' => 'backend\components\SwitchAction',
				'className' => Nav::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
				//'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all Nav models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$dataProvider = new ActiveDataProvider([
    		'query' => Nav::find()->alive(),
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
//     	$keys = General::getModelsKeys($dataProvider->models, 'id');
//     	$dataProvider->setKeys($keys);
    	
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nav model.
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
     * Creates a new Nav model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nav();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	return $this->redirect(['index']);
//             return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Nav model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	return $this->redirect(['index']);
//             return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Nav model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nav the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nav::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
