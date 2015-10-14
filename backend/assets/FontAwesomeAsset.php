<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
    	'css/font-awesome.min.css'
    ];
}
