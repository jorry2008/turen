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
class SweetAlertAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert/dist';
    public $css = [
        'sweetalert.css',
    	//'../google/google.css',
    ];
    public $js = [
    	'sweetalert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
