<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class PrettyUpLoadAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-3-pretty-file-upload';
    public $css = [];
    public $js = [
        //注意语言包的顺序，一定要在后台引入
        'bootstrap-prettyfile.js',
    ];
    
    public $depends = [
    	'yii\web\YiiAsset',
    ];
}


