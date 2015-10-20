<?php

namespace frontend\modules\site\controllers;

class JiriController extends \frontend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
