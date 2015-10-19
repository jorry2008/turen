<?php

namespace frontend\modules\site\controllers;

use Yii;
use yii\helpers\Json;
use common\models\order\Call;
use common\models\order\Info;

class OrderController extends \frontend\components\Controller
{
	/**
	 * ajax预约
	 * @return string
	 */
	public function actionCall()
	{
		if(Yii::$app->getRequest()->isAjax) {
			$params = Yii::$app->getRequest()->get();
			if($params) {
				$model = new Call;
				$result = $model->call($params);
				echo Json::encode(['result'=>$result, 'msg'=>'']);
			}
			Yii::$app->end();
		} else {
			//异常
		}
	}
	
	/**
	 * 快速创建订单
	 */
    public function actionQickOrder()
    {
        return $this->render('qick-order');
    }
    
    /**
     * 在线预约
     * @return string
     */
    public function actionOnlineCall()
    {
    	return $this->render('call');
    }
}
