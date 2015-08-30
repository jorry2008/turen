<?php
/**
 * @link http://www.yijitao.com/
 * @copyright Copyright (c) 2008 yijitao Software LLC
 * @license
 */

namespace backend\components;

use Yii;
use backend\assets\BackendAsset;

//use yii\filters\VerbFilter;
//use common\models\user\User;
//use yii\filters\AccessControl;
use backend\components\AccessControl;
use backend\components\AccessRule;
use yii\helpers\ArrayHelper;


//use yii\web\ForbiddenHttpException;

/**
 * @author jorry
 * @since 1.0
 */

//后台统一控制器
class Controller extends \yii\web\Controller
{
    public $baseUrl;
    
    /**
     * 初始化
     * @see \yii\base\Object::init()
     */
    public function init()
    {
        parent::init();
         
        //初始化web目录下的资源路径
        $this->baseUrl = Yii::getAlias('@web');
    }
    
    /**
     * 整个系统后台的权限控制入口
     * @inheritdoc
     */
    public function behaviors()
    {
        //*****首先你应该匹配了才知道有没有权限（默认是匹配状态）******
        return [
            // To use AccessControl, declare it in the `behaviors()` method of your controller class.
            // 此行为作用于controller
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout'],
                /*
                'denyCallback' => function($rule, $action){
                    //fb('执行到这里，说明未找到任何匹配');
                    $user = Yii::$app->getUser();
                    if($user->getIsGuest()) {//未登录
                        //发出提示并跳转到一个权限提示页面
                        Yii::$app->getSession()->setFlash('danger', Yii::t('common', 'You have not login, please login first.'));
                        $user->loginRequired();
                    } else {//无权限
                        throw new ForbiddenHttpException(Yii::t('common', 'You don\'t have this permission!'));
                    }
                },
                */
                //配置rbac(角色权限访问控制)
                'ruleConfig' => [
                    'class' => AccessRule::className(),//过滤的个数由rules决定
                ],
                //普通的配置规则ACF(访问控制过滤)（优先）
                'rules' => [
                    [//允许action
                        'allow' => true,
                        'actions' => $this->getActions(),
                    ], [//禁止的ip
                        'allow' => false,
                        'ips' => $this->getIps(),
                    ], [//禁止的controller
                        'allow' => false,
                        'controllers' => $this->getControllers(),
                    ], [//禁止动作
                        'allow' => false,
                        'verbs' => $this->getVerbs(),
                    ], [//允许角色
                        'allow' => true,
                        'roles' => $this->getRoles(),
                        //'matchCallback' => function($rule, $action){fb('b');},//自定义匹配回调
//                         'denyCallback' => function($rule, $action){//拒绝回调
//                             Yii::$app->getSession()->setFlash('danger' ,'You don\'t have this permission!');
//                         },
                    ]
                ],
            ],
        ];
    }
    
    /**
     * 来自配置文件的数据
     * @return Ambigous <multitype:, unknown, mixed>
     */
    public function getActions()
    {
        $actions = explode(',', Yii::$app->params['config']['config_access_action']);//默认允许的action
        return ArrayHelper::merge($actions, ['login' ,'logout', 'captcha', 'error']);//'login', 
    }
    
    /**
     * 来自配置文件的数据
     * @return Ambigous <multitype:, unknown, mixed>
     */
    public function getControllers()
    {
        $controllers = explode(',', Yii::$app->params['config']['config_access_controller']);
        return ArrayHelper::merge($controllers, [1]);//'user/common'//注意写法，为1时，是为了默认不匹配
    }
    
    /**
     * 来自配置文件的数据
     * @return Ambigous <multitype:, unknown, mixed>
     */
    public function getIps()
    {
        $ips = explode(',', Yii::$app->params['config']['config_access_ip']);
        return ArrayHelper::merge($ips, [1]);//默认是匹配的，同上
    }
    
    /**
     * 来自配置文件的数据
     * @return Ambigous <multitype:, unknown, mixed>
     */
    public function getVerbs()
    {
        $verbs = explode(',', Yii::$app->params['config']['config_access_verb']);
        return ArrayHelper::merge($verbs, [1]);//默认是匹配的，同上
    }
    
    /**
     * 当前用户的角色
     * 注意：这里角色将在后面的规则accessRule中添加当前访问的页面
     * @return multitype:string
     */
    public function getRoles()
    {
        $user = Yii::$app->getUser();
        $roles = [];//指定一些权限项不可访问
        //fb(Yii::$app->getUrlManager()->parseRequest(Yii::$app->getRequest()));
        return ArrayHelper::merge($roles, ['^_^']);//默认是匹配的，同上;这里比较特殊，只要不为空，才能进行到下一步
    }
    
    
    /**
     * 切换状态
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionSwitchStauts($id)
    {
    	$model = $this->findModel($id);
    	$model->status = $model->status?0:1;//取反
    	$model->save(false);
    	return $this->redirect(['index']);
    }
    
    /**
     * 假删除动作
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	$model->deleted = 1;
    	$model->save(false);//更新
    
    	return $this->redirect(['index']);
    }
}

