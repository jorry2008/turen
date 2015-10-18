<?php

namespace frontend\modules\account\controllers;

class OrderController extends \frontend\components\Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }
    
    public function actionList()
    {
    	//本人的订单
    	return $this->render('list');
    }
    
    public function actionView($id)
    {
    	return $this->render('view');
    }
}
