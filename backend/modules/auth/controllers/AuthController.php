<?php

namespace backend\modules\auth\controllers;

use Yii;
use common\models\auth\AuthItem;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\rbac\Item;

class AuthController extends Controller
{
    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find()->where(['type'=>Item::TYPE_ROLE]),//只处理角色
            'pagination' => [
                'class' => 'yii\data\Pagination',
                'defaultPageSize' => 16,
            ],
            'sort' => [
                'class' => 'yii\data\Sort',
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
            ],
        ]);
    
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 添加权限到角色
     */
    public function actionConfig($id)
    {
        $role = $id;
        $authManager = Yii::$app->getAuthManager();
        $roleModel = $this->findAuthItemModel($role);
        
        if(Yii::$app->getRequest()->post()) {
            //清空当角色的所有权限
            $authManager->removeItems($role);
            
            foreach (Yii::$app->getRequest()->post() as $key=>$value) {
                if(!empty($value) && is_array($value)) {
                    if(in_array($key, $value)) {//只存task
                        if(!$authManager->hasChild($authManager->getRole($role), $authManager->getTask($key))) {
                            $authManager->addChild($authManager->getRole($role), $authManager->getTask($key));
                        }
                    } else {//只存permission
                        foreach ($value as $item) {
                            if(!$authManager->hasChild($authManager->getRole($role), $authManager->getPermission($item))) {
                                $authManager->addChild($authManager->getRole($role), $authManager->getPermission($item));
                            }
                        }
                    }
                }
            }
            
            //提示更新成功
            Yii::$app->getSession()->setFlash('success', Yii::t('auth', 'Update Role Success'));
        }
        
        $tasksAndPermissions = $authManager->getTasksAndPermissions();
        $selectItems = ArrayHelper::merge($authManager->getPermissionsByRole($role), $authManager->getTasksByRole($role));
        $selectItems = array_keys($selectItems);
        
        return $this->render('config', [
            'tasksAndPermissions' => $tasksAndPermissions,
            'selectItems' => $selectItems,
            'model' => $roleModel,
            'id' => $role,
        ]);
    }
    
    
    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAuthItemModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
