<?php

namespace backend\components;

use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\base\InvalidParamException;
use yii\helpers\Url;

/**
 * 负责模型中0、1的各种状态切换
 * @author Jorry <980522557@qq.com>
 *
 */
 
/*
 * 使用方法：
 * public function actions()
 {
	 return [
		 'switch-status' => [
			 'class' => 'backend\components\SwitchAction',
			 'className' => Product::className(),
			 'id' => Yii::$app->getRequest()->get('id'),
			 'feild' => 'status',
			 'route' => '/catalog/product/index',
		 ],
	 ];
 } */
 
class SwitchAction extends Action
{
    public $className;//要切换的模型
    public $id;//主键id值
    
    public $feild = 'status';//指定要修改的字段名[可选]
    public $route = 'index';//修改完成后，跳转到的路由[可选]
    public $value;//默认值,如果不是简单的切换，则会指定一个值[可选]
    
//     public function init()
//     {
//         parent::init();
//     }

    public function run()
    {
    	$feild = $this->feild;
    	//校验参数
    	if(empty($this->className) || empty($this->id)) {
    		throw new InvalidParamException(Yii::t('common', 'Parameter Error.'));
    	}
    	
    	//状态切换
    	$model = $this->findModel($this->id);
    	$model->$feild = is_null($this->value)?($model->$feild?0:1):$this->value;
    	$model->save(false);
    	return Yii::$app->getResponse()->redirect(Url::to([$this->route]));
    }
    
    protected function findModel($id)
    {
    	$className = $this->className;
    	if (($model = $className::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
