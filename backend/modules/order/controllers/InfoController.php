<?php

namespace backend\modules\order\controllers;

use Yii;
use common\models\order\Info;
use common\models\order\InfoSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'delete' => [
				'class' => 'backend\components\SwitchAction',
				'className' => Info::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
//				'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all Info models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Info model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	//更新已读
    	$model = $this->findModel($id);
    	$model->is_view = Info::STATUS_YES;
    	$model->save(false);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Info model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Info();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Info model.
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
     * Deletes an existing Info model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Info model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Info the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Info::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
