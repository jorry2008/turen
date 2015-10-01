<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
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
