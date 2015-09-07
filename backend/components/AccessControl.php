<?php

namespace backend\components;

use Yii;
use yii\web\ForbiddenHttpException;

class AccessControl extends \yii\filters\AccessControl
{
	/**
	 * @see \yii\filters\AccessControl::init()
	 */
	public function init()
	{
		parent::init();
		
		//非正式环境下，每次请求都要对当前页面的权限进行检查
		if(!YII_ENV_PROD)
			$this->checkAuthItem();
	}
	
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            Yii::$app->getSession()->setFlash('danger', Yii::t('common', 'You have not login, please login first.'));
            $user->loginRequired();
        } else {
            //检查权限是否有配置
//             $this->checkAuthItem();
            
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
    
    /**
     * 检查权限是否存在，并开启提醒
     */
    protected function checkAuthItem()
    {
    	$route = str_replace(['/', '\\'], '/', Yii::$app->requestedRoute);
    	$routes = explode('/', $route);
    	if(count($routes) == 3) {
    		$authManager = Yii::$app->getAuthManager();
    		if (!$authManager instanceof DbManager) {
    			throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
    		}
    		
    		$route_1 = $routes[0].'/'.$routes[1];
    		$route_2 = $route;

    		$parentPermission = $authManager->getTask($route_1);
    		if(!$parentPermission) {
    			$parentPermission = $authManager->createPermission($route_1);
    			$parentPermission->description = str_replace(['/', '-'], ' ', $route_1);
    			$parentPermission->type = \backend\components\Task::TYPE_TASK;//里增加一个任务类型
    			$authManager->add($parentPermission);
    		}
    		
    		//创建子权限
    		$childPermission = $authManager->getPermission($route_2);
    		if(!$childPermission) {
    			$childPermission = $authManager->createPermission($route_2);
    			$childPermission->description = str_replace(['/', '-'], ' ', $route_2);
    			$authManager->add($childPermission);
    		}
    		
    		//将子权限添加到父权限
    		if(!$authManager->hasChild($parentPermission, $childPermission))
    			$authManager->addChild($parentPermission, $childPermission);
    	}
    	
        return true;
    }
    
//     public function beforeFilter($event)
//     {
//         parent::beforeFilter($event);
//         return true;
//     }
}
