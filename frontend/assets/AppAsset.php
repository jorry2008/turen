<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	'css/common.css',
    	'css/home.css',
    	'css/account.css',
    	'css/site.css'
    ];
    public $js = [
    	'js/site.js',
    ];
    
    public $depends = [
        '\frontend\assets\NormalizeCssAsset',
    	'\frontend\assets\FontAwesomeAsset',
    	'\frontend\assets\ToTopAsset',
    	'\frontend\assets\SweetAlertAsset',//全局弹出窗
    ];
}
