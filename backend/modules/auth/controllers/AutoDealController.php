<?php
namespace backend\modules\auth\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use backend\components\Controller;

use yii\base\InvalidConfigException;
use yii\rbac\DbManager;
use backend;

/**
 * AuthRuleController implements the CRUD actions for AuthRule model.
 */
class AutoDealController extends Controller
{
    public static $_files = [];
    
    /**
     * 获取权限管理实例
     * @throws InvalidConfigException
     * @return Ambigous <\admin\modules\auth\controllers\DbManager, \yii\rbac\ManagerInterface, object, NULL, multitype:, \Closure, mixed>
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();//注意，这个是控制台环境，所以也必须在控制台配置中对应配置
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }
    
    public function actionCreateItems()
    {
        if (!Yii::$app->getUser()->getIdentity()->is_admin) {
            echo Json::encode([
                'status' => 1,
                'msg' => Yii::t('auth', 'You are not the super administrator can\'t do this!')
            ]);
            
            Yii::$app->end();
        }
        
        if (isset(Yii::$app->params['authPath']) && ! empty(Yii::$app->params['authPath'])) {
            $realPath = Yii::getAlias(Yii::$app->params['authPath']);
            
            // 只过滤出controllers
            $options = [
                'filter' => 'backend\modules\auth\controllers\AutoDealController::filterAuthFile'
            ];
            FileHelper::findFiles($realPath, $options);
            
            $this->addItem(self::$_files); // 异常处理
            
            echo Json::encode([
                'status' => 0,
                'msg' => Yii::t('auth', 'Reset Auth Success')
            ]);
        } else {
            echo Json::encode([
                'status' => 1,
                'msg' => Yii::t('auth', 'Auth Path is Empty!')
            ]);
        }
        Yii::$app->end();
    }

    /**
     * 取与权限相关的类路径
     * @param string $path
     */
    public static function filterAuthFile($path)
    {
        if (is_file($path) && (strpos($path, 'controllers') !== false)) {
            self::$_files[] = $path;
        }
    }

    /**
     * 开始创建权限
     * @param array $files
     * @throws \yii\base\NotSupportedException
     */
    protected function addItem($files)
    {
        $authManager = $this->getAuthManager();
        //清空操作
        $authManager->removeAllPermissions();
        //清空任务
        $authManager->removeAllTasks();
        
    	//当前只考虑一层模块的情况！！！
        foreach ($files as $file) {
            $parentPermission = null;
            
            $authPath = str_replace('@', '', Yii::$app->params['authPath']);
            $file = substr($file, strpos($file, $authPath));
            $nameSpace = str_replace(['/', '.php'], ['\\', ''], $file);
            
            //创建主权限（每个controller就是一个权限组）
            $module = substr($nameSpace, (strpos($nameSpace, 'modules')+7), (strpos($nameSpace, 'controllers')-strpos($nameSpace, 'modules')-7));
            $module = $this->setCapital(str_replace('\\', '', $module));
            $controller = substr($nameSpace, (strpos($nameSpace, 'controllers')+11));
            $controller = $this->setCapital(str_replace(['\\', 'Controller'], '', $controller));
            $route = $module.'/'.$controller;
            
            $parentPermission = $authManager->getPermission($route);
            if(!$parentPermission) {
                $parentPermission = $authManager->createPermission($route);
                $parentPermission->description = ucwords($module.' '.$controller.' '.'permission group');
                $parentPermission->type = backend\components\Task::TYPE_TASK;//里增加一个任务类型
                $parentPermission->createdAt = time();
                $parentPermission->updatedAt = time();
                $authManager->add($parentPermission);
            }
            
            //反射
            $class = new \ReflectionClass($nameSpace);
            $properties = $class->getProperties();
            $methods = $class->getMethods();
            foreach ($methods as $method) {
                $childPermission = null;
                
                if($method->isPublic()) {//public方法
                    $methodName = $method->getName();
                    if($methodName == 'actions') {
                        if($method->class !== 'yii\base\Controller') {
                            if(method_exists($nameSpace, 'getRbac')) {//手动配置actions里面的控制器
                                //创建子权限
                                if($actions = $nameSpace::getRbac()) {
                                    foreach ($actions as $action) {
                                        $action = $this->setCapital($action);
                                        $this->addSubPermission($parentPermission, $route, $module, $controller, $action);
                                    }
                                }
                            } else {
                                throw new \yii\base\NotSupportedException(Yii::t('auth', $nameSpace.'::getRbac() Not Found!'));
                            }
                        }
                    } else {
                        if(strpos($methodName, 'action') === 0) {
                            $action = $this->setCapital(str_replace('action', '', $methodName));
                            $this->addSubPermission($parentPermission, $route, $module, $controller, $action);
                        }
                    }
                }
            }  
        } 
    }
    
    /**
     * 添加子权限
     */
    protected function addSubPermission($parentPermission, $route, $module, $controller, $action)
    {
        $authManager = $this->getAuthManager();
        
        $subRoute = $route.'/'.$action;
        //创建子权限
        $childPermission = $authManager->getPermission($subRoute);
        if(!$childPermission) {
            $childPermission = $authManager->createPermission($subRoute);
            $childPermission->description = ucwords($module.' '.$controller.' '.$action.' '.'permission');
            $childPermission->createdAt = time();
            $childPermission->updatedAt = time();
            $authManager->add($childPermission);
        }
        
        //将子权限添加到父权限
        if(!$authManager->hasChild($parentPermission, $childPermission)) {
            $authManager->addChild($parentPermission, $childPermission);
        }
    }
    
    /**
     * 判断是否有大写字母并设为'-'
     */
    protected function setCapital($str)
    {
        //首位大写转小写
        $str = strtolower(substr($str, 0, 1)).substr($str, 1);
        if(strtolower($str) === $str){
            return $str;
        } else {
            $newStr = '';
            for ($i = 0; $i < strlen($str); $i++) {
                $key = $i;
                $value = $str[$i];
                if($value !== strtolower($value)) {
                    $newStr .= '-'.strtolower($value);
                } else {
                    $newStr .= $value;
                }
            }
        }
        
        return $newStr;
    }
    
//     public function actionTest()
//     {
//         $test = 'TestAction';
//         fb($this->setCapital($test));
//     }
}

