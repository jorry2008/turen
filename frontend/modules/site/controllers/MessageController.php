<?php

namespace frontend\modules\site\controllers;

class MessageController extends \frontend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
