<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Jorry <980522557@qq.com>
 * @since 2.0
 */
 
class ColorPickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/AdminLTE/plugins/colorpicker';
    public $css = [
        'bootstrap-colorpicker.min.css',
    ];
    public $js = [
        //注意语言包的顺序，一定要在后台引入
        'bootstrap-colorpicker.min.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}


