<?php

namespace backend\components\uploadify;

use yii\web\AssetBundle;

class UploadifyAsset extends AssetBundle
{
    public $sourcePath = '@app/components/uploadify/assets/uploadify/';
    public $css = [
        'uploadify.css',
    ];
    public $js = [
        'jquery.min.js',
        'jquery.uploadify.js'
    ];
    //public $depends = [];
    
}