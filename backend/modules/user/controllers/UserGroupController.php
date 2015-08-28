<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\user\UserGroup;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class UserGroupController extends Controller
{
    /**
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserGroup::find(),
            'pagination' => [
                'class' => 'yii\data\Pagination',
                'defaultPageSize' => 16,
            ],
    
            'sort' => [
                'class' => 'yii\data\Sort',
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                ],
            ]
        ]);
        
//         $total = $dataProvider->getTotalCount(); // 整个数据库表的总数(使用这个，可以触发前端知道还有next页面)
//         $models = $dataProvider->getModels();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroup model.
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
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserGroup model.
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
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->isExistUser([$id])) {//管理员组下是否存在管理员
            Yii::$app->session->setFlash('warning', Yii::t('user', 'Delete failure, group contains the administrator!'));
        } else {
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
