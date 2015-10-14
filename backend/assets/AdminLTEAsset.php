<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */

class AdminLTEAsset extends AssetBundle
{
    //这个属性是设置不能被web访问资源
    public $sourcePath = '@bower/AdminLTE/dist';
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

/**
 * 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
*/
