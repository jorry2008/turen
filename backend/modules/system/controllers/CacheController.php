<?php

namespace backend\modules\system\controllers;

class CacheController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
