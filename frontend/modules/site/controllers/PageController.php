<?php

namespace frontend\modules\site\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\cms\Column;

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
    public function actionView($name)
    {
    	return $this->render('view', [
    			'model' => $this->findModel($name),
    	]);
    }
    
    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
    	if (($model = Column::find()->with('page')->active()->andWhere(['short_code'=>trim($name)])->one()) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('该请求对应的页面不存在。');
    	}
    }
}
