<?php
/**
 * 后台基础资源，它将在布局文件main中注入
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	'css/site.css'
    ];
    public $js = [
    	'js/site.js',
    ];
    
    public $depends = [
        '\backend\assets\BootstrapAsset',//bootstartp
    	'\backend\assets\FontAwesomeAsset',//字体1
    	'\backend\assets\IoniconsAsset',//字体2
    	'\backend\assets\AdminLTEAsset',//adminLTE
//     	'\backend\assets\ToTopAsset',//返回顶部
    ];
}
