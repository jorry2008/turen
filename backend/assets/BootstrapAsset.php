<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
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
    public $depends = [
    	'yii\web\YiiAsset',
    ];
}