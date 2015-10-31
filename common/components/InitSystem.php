<?php
/**
 * @link http://www.yijitao.com/
 * @copyright Copyright (c) 2008 yijitao Software LLC
 * @license
 */

namespace common\components;

use Yii;
use yii\base\InvalidConfigException;
use common\models\system\Setting;

/**
 * @author jorry
 * @since 1.0
 */

//普通的导入类方式
class InitSystem extends \yii\base\Component {
	//后台统一控制器
	function init()
	{
		parent::init();
		
		if(!$this->initConfig()) {
		    throw new InvalidConfigException('InitSystem::initConfig Failed To Initialize!');
		}
		if(!$this->initCustom()) {
		    throw new InvalidConfigException('InitSystem::initCustom Failed To Initialize!');
		}
	}
	
	/**
	 * 初始化系统配置
	 */
	protected function initConfig()
	{
	    Yii::$app->params['config'] = (new Setting)->getCache();
	    return true;
	}
	
	/**
	 * 初始化并重新配置系统里的默认参数
	 */
	protected function initCustom()
	{
	    // 后台配置多语言
	    Yii::$app->params['config'];
	    
	    // 后台配置模板
	    
	    // 后台配置
	    Yii::$app->name = Yii::$app->params['config']['config_base_name'];
	    
	    //配置邮箱服务器
	    
// 	    fb(Yii::$app->params['config']);
// 	    ['config_email_host'] =>'smtp.163.com'
// 	    ['config_email_username'] =>'xiayouqiao2008@163.com'
// 	    ['config_email_password'] =>'13635862687xyqss'
// 	    ['config_email_port'] =>25
// 	    ['config_email_to'] =>'2971030686@qq.com'
// 	    ['config_email_bcc'] =>'980522557@qq.com'
	    
// 	    fb(Yii::$app->mailer->getTransport());
	    
	    // ...
	    
	    return true;
	}
}






