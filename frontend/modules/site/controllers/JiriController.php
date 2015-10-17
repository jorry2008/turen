<?php

namespace frontend\modules\site\controllers;

class JiriController extends \frontend\components\Controller
{
    public function actionList()
    {
        return $this->render('list');
    }

}
