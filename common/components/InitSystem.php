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
	    Yii::$app->name = Yii::$app->params['config']['config_site_name'];
	    
	    
	    // ...
	    
	    return true;
	}
}






