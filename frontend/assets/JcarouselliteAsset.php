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
class JcarouselliteAsset extends AssetBundle
{
    public $sourcePath = '@bower/jcarousellite';
    public $js = [
    	'jquery.jcarousellite.min.js',
    ];
    public $depends = [
        'frontend\assets\YiiAsset',
    ];
}
