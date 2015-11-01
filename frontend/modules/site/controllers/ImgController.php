<?php

namespace frontend\modules\site\controllers;

use Yii;
use common\models\cms\Column;
use common\models\cms\Img;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ImgController extends \frontend\components\Controller
{
	/**
	 * 新闻列表
	 * @param int $id
	 * @return string
	 */
	public function actionList()
	{
		$column = Column::findOne(['short_code' => Yii::$app->getRequest()->get('name', '')]);
		if(empty($column)) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
		//检索与分页
		$query = $column->getImg()->orderBy('publish_at DESC');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->params['config']['config_site_default_page_size'],
			],
		]);
		
		return $this->render('list', [
			'columnModel' => $column,
			'dataProvider' => $dataProvider
		]);
	}
	
	/**
	 * 新闻详情
	 * @param int $id
	 */
    public function actionView($id)
    {
        return $this->render('view', [
        	'model' => $this->findModel($id),
        ]);
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
    	if (($model = Img::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
