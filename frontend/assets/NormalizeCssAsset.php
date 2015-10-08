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
class NormalizeCssAsset extends AssetBundle
{
    public $sourcePath = '@bower/normalize-css';
    public $css = [
        'normalize.css',
    ];
    public $depends = [
        'frontend\assets\YiiAsset',
    ];
}
