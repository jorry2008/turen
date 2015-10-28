<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components\behaviors;

use Yii;
use yii\base\Behavior;

class HelpBehavior extends Behavior
{
    public function help()
    {
        fb('help');
        return 'Help';
    }
}
