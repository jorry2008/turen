<?php

namespace frontend\modules\site\controllers;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
