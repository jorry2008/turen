<?php

namespace backend\modules\extend\controllers;

use Yii;
use common\models\extend\LinkType;
use common\models\extend\Link;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * LinkTypeController implements the CRUD actions for LinkType model.
 */
class LinkTypeController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'switch-status' => [
				'class' => 'backend\components\SwitchAction',
				'className' => LinkType::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'status',
// 				'route' => '/extend/nav/index',
			],
			'delete' => [
				'class' => 'backend\components\SwitchAction',
				'className' => LinkType::className(),
				'id' => Yii::$app->getRequest()->get('id'),
				'feild' => 'deleted',
				'value' => 1,
//				'route' => '/cms/column/index',
			]
		];
	}
	
    /**
     * Lists all LinkType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LinkType::find()->alive(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LinkType model.
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
     * Creates a new LinkType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LinkType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LinkType model.
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
     * 假删除动作(重写)
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
    	if(Link::find()->where(['link_type_id'=>$id])->alive()->exists()) {
    		Yii::$app->getSession()->setFlash('warning', Yii::t('extend', 'Have links under the link type, cannot be deleted'));
    	} else {
    		$model = $this->findModel($id);
    		$model->deleted = 1;
    		$model->save(false);//更新
    	}
    	
    	return $this->redirect(['index']);
    }

    /**
     * Finds the LinkType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LinkType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LinkType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
