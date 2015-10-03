<?php

namespace frontend\modules\site\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\cms\Page;

class PageController extends \frontend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	return $this->render('view', [
    			'model' => $this->findModel($id),
    	]);
    }
    
    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = Page::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException(Yii::t('common', '该请求对应的页面不存在。'));
    	}
    }
}
