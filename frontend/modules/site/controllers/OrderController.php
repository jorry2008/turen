<?php

namespace frontend\modules\site\controllers;

class OrderController extends \frontend\components\Controller
{
	/**
	 * 快速创建订单
	 */
    public function actionQickOrder()
    {
        return $this->render('qick-order');
    }
    
    /**
     * 预约
     * @return string
     */
    public function actionCall()
    {
    	return $this->render('call');
    }
}
