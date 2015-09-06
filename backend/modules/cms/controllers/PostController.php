<?php

namespace backend\modules\cms\controllers;

use Yii;
use yii\web\NotFoundHttpException;

use common\models\cms\Post;
use common\models\cms\PostSearch;
use backend\components\Controller;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
