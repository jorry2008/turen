<?php

namespace frontend\modules\site\controllers;

class NewsController extends \frontend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
