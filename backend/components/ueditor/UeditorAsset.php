<?php

namespace backend\components\ueditor;

use yii\web\AssetBundle;

class UeditorAsset extends AssetBundle
{
    public $sourcePath = '@app/components/ueditor/assets/';
    
    public $js = ['ueditor.config.js'];
    
    //public $css = [];
    
    //public $depends = ['yii\web\JqueryAsset'];
    
    public function init()
    {
        parent::init();
    
        $this->js[] =  YII_DEBUG ? 'ueditor.all.js' : 'ueditor.all.min.js';
    }
}
