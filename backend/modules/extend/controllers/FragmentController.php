<?php

namespace backend\modules\extend\controllers;

use Yii;
use common\models\extend\Fragment;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * FragmentController implements the CRUD actions for Fragment model.
 */
class FragmentController extends Controller
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
			'ueditor' => [
				'class' => \backend\components\ueditor\UeditorAction::className(),
			],
			'switch-status' => [
				'class' => \backend\components\SwitchAction::className(),
				'className' => Fragment::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'status',
// 				'route' => '/extend/nav/index',
			],
			'delete' => [
				'class' => \backend\components\SwitchAction::className(),
				'className' => Fragment::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
// 				'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all Fragment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Fragment::find()->alive(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fragment model.
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
     * Creates a new Fragment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fragment();

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
     * Updates an existing Fragment model.
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
     * Finds the Fragment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fragment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fragment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
