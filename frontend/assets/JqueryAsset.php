<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author xia.q
 */
class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery1.11.3';
    public $js = [
        'jquery-1.11.3.min.js',
    ];
}
