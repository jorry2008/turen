<?php

namespace backend\components;

use Yii;
use yii\web\ForbiddenHttpException;

class AccessControl extends \yii\filters\AccessControl
{
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            Yii::$app->getSession()->setFlash('danger', Yii::t('common', 'You have not login, please login first.'));
            $user->loginRequired();
        } else {
            //检查权限是否有配置
            $this->checkAuthItem();
            
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
    
    /**
     * 检查权限是否存在，并开启提醒
     */
    protected function checkAuthItem()
    {
        
        
        
        return true;
    }
    
//     public function beforeFilter($event)
//     {
//         parent::beforeFilter($event);
//         return true;
//     }
}
