<?php

namespace backend\modules\extend\controllers;

use Yii;
use common\models\extend\Job;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'switch-status' => [
				'class' => 'backend\components\SwitchAction',
				'className' => Job::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'status',
// 				'route' => '/extend/nav/index',
			],
			'delete' => [
				'class' => 'backend\components\SwitchAction',
				'className' => Job::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
//				'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Job::find()->alive(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
