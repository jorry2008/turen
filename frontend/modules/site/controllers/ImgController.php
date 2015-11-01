<?php

namespace frontend\modules\site\controllers;

use common\models\cms\Column;
use common\models\cms\Post;

class ImgController extends \frontend\components\Controller
{
	/**
	 * 新闻列表
	 * @param int $id
	 * @return string
	 */
	public function actionList()
	{
		$column = Column::findOne(['short_code'=>'news']);
		return $this->render('list', [
			'columnModel' => $column,
			'postmodels' => $column->getPost()->orderBy('publish_at DESC')->all(),
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
    	if (($model = Post::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
