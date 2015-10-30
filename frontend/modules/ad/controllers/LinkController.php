<?php

namespace frontend\modules\ad\controllers;

use common\models\cms\Ad;
use yii\web\NotFoundHttpException;
use yii\validators\UrlValidator;

class LinkController extends \frontend\components\Controller
{
	/**
	 * 所有的广告入口
	 * @param string $name 广告标识
	 * @param string $key 跟踪代码，表示广告来源，默认为pc站内广告
	 */
	public function actionAdClick($name, $key='')
	{
		$model = Ad::findOne(['short_code'=>trim($name)]);
		if($model) {
			//根据$key各种统计与分析
			
			//增加一次点击
			$model->hits = $model->hits+1;
			$model->save(false);
			
			//验证url是否合法
			$v = new UrlValidator();
			if($v->validate($model->link_url)) {
				//跳转到广告指定的位置
				$this->redirect($model->link_url);
			}
		}
		
		//网站直接404
		throw new NotFoundHttpException('The requested page does not exist.');
	}
    
    /**
     * Finds the Ad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = Ad::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
