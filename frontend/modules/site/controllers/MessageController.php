<?php

namespace frontend\modules\site\controllers;

class MessageController extends \frontend\components\Controller
{
    public function actionSend()
    {
        return $this->render('send');
    }

}
