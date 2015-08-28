<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\extensions\AdminLTE;

use yii\web\AssetBundle;

/**
 *
 * @author xia.q
 *
 */
class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
}

class AdminLTEAsset extends AssetBundle
{
    //这个属性是设置不能被web访问资源
    public $sourcePath = '@app/extensions/AdminLTE/dist/';
    
    //这两个则是设置外部资源或者web可访问资源
//     public $basePath = '@webroot';
//     public $baseUrl = '@web';

    public $css = [
        //'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'font-awesome/css/font-awesome.css',
        'ionicons/css/ionicons.min.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'backend\extensions\AdminLTE\BootstrapAsset',
    ];
}


/**
 * 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
*/



