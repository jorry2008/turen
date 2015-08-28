<?php

namespace backend\modules\system\controllers;

class DbController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
