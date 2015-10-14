<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class ToTopAsset extends AssetBundle
{
    public $sourcePath = '@bower/jQuery.toTop';
    public $js = [
        'jquery.toTop.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
