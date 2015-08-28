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
class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@app/extensions/AdminLTE/plugins/slimScroll/';
    public $js = [
        'jquery.slimscroll.min.js',
    ];
    
    public $depends = [
        'backend\assets\BackendAsset'
    ];
}


