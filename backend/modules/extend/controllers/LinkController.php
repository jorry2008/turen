<?php

namespace backend\modules\extend\controllers;

use Yii;
use common\models\extend\Link;
use common\models\extend\LinkSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * LinkController implements the CRUD actions for Link model.
 */
class LinkController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'file-upload' => [
				'class' => \backend\components\FileUploadAction::className(),
			],
			'switch-status' => [
				'class' => \backend\components\SwitchAction::className(),
				'className' => Link::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'status',
// 				'route' => '/extend/nav/index',
			],
			'delete' => [
				'class' => \backend\components\SwitchAction::className(),
				'className' => Link::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
// 				'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all Link models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Link model.
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
     * Creates a new Link model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Link();

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
     * Updates an existing Link model.
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
     * Finds the Link model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Link the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Link::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
