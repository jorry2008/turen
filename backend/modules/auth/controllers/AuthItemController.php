<?php

namespace backend\modules\auth\controllers;

use Yii;
use common\models\auth\AuthItem;
use common\models\auth\AuthItemSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\rbac\Item;


/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
{
    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($name)
    {
        return $this->render('view', [
            'model' => $this->findModel($name),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->createItem()) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $model = $this->findModel($name);
        if ($model->load(Yii::$app->request->post())) {
	        //如果是角色，则有改name的风险
	        if($model->getOldAttribute('type') == Item::TYPE_ROLE && $model->existByUser($name) && ($model->getOldAttribute('name') != $model->getAttribute('name'))) {
	        	Yii::$app->getSession()->setFlash('warning', Yii::t('auth', 'Update failure,this role has been used,do not modify the role name!'));
// 	        	$model->refresh();
	        	return $this->redirect(['update', 'name'=>$model->getOldAttribute('name')]);
	        } else {
	        	//使用api更新
	        	$model->updateItem();
	        	return $this->redirect(['view', 'name'=>$model->name]);
	        }
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($name)
    {
        $model = $this->findModel($name);
        if($model->type == (Item::TYPE_ROLE) && $model->existByUser($name)) {
            Yii::$app->getSession()->setFlash('warning', Yii::t('auth', 'Delete failure,this role has been used!'));
        } else {
            $model->deleteItem();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = AuthItem::findOne(['name'=>$name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
