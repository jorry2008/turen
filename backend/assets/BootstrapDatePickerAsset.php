<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapDatePickerAsset extends AssetBundle
{
    public $sourcePath = '@app/extensions/AdminLTE/plugins/bootstrap-datetimepicker/';
    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];
    public $js = [
        //注意语言包的顺序，一定要在后台引入
        'js/bootstrap-datetimepicker.min.js',
    ];
    
    public $depends = [
        'backend\assets\BackendAsset'
    ];
    
	public function init()
	{
		parent::init();
		$this->js[] = 'js/locales/bootstrap-datetimepicker.'.Yii::$app->language.'.js';
	}
}


