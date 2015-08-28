<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@app/extensions/AdminLTE/plugins/select2/';
    public $css = [
        'select2.min.css',
    ];
    public $js = [
        //注意语言包的顺序，一定要在后台引入
        'select2.min.js',
        'i18n/zh-CN.js',
    ];
    
    public $depends = [
        'backend\assets\BackendAsset'
    ];
}


