<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class BootstrapDatePickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/smalot-bootstrap-datetimepicker';
    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];
    public $js = [
        //注意语言包的顺序，一定要在后台引入
        'js/bootstrap-datetimepicker.min.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
	public function init()
	{
		parent::init();
		$this->js[] = 'js/locales/bootstrap-datetimepicker.'.Yii::$app->language.'.js';
	}
}


