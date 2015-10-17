<?php

namespace frontend\modules\site\controllers;

class OrderController extends \frontend\components\Controller
{
    public function actionQickOrder()
    {
        return $this->render('qick-order');
    }
    
    public function actionCall()
    {
    	return $this->render('call');
    }

}
