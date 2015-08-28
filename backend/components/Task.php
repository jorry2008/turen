<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components;

use yii\rbac\Item;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Task extends Item
{
    const TYPE_TASK = 3;
    
    /**
     * @inheritdoc
     */
    public $type = self::TYPE_TASK;
}
