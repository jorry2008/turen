<?php

namespace frontend\modules\site\controllers;

class PageController extends \frontend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
