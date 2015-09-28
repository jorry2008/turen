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
class BaseAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $css = [
        'normalize-css/normalize.css',
    	'font-awesome/css/font-awesome.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
