<?php

namespace frontend\modules\site\controllers;

class PageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
