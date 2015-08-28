<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\user\User;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),//->with('userGroup'),
            'pagination' => [
                'class' => 'yii\data\Pagination',
                'defaultPageSize' => 16,
            ],
        
            'sort' => [
                'class' => 'yii\data\Sort',
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario'=>'create']);
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password);//强制入库
            $model->generateAuthKey();//强制入库
            
            if ($model->save()) {
                Yii::$app->getAuthManager()->assign(Yii::$app->getAuthManager()->getRole($model->role_name), $model->id);//授权操作
                Yii::$app->getSession()->setFlash('success', Yii::t('common', 'Create Success!'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('warning', Yii::t('common', 'Create Failure!'));
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        if ($model->load(Yii::$app->getRequest()->post())) {
            if(!empty(Yii::$app->getRequest()->post()['User']['password'])) {
                $model->setPassword($model->password);//强制入库
            }
            if($model->save()) {
                Yii::$app->getAuthManager()->revokeAll($id);
                Yii::$app->getAuthManager()->assign(Yii::$app->getAuthManager()->getRole($model->role_name), $id);//授权操作
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('warning', Yii::t('common', 'Update Failure!'));
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
