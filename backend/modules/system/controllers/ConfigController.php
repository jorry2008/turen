<?php

namespace backend\modules\system\controllers;

use Yii;
use common\models\system\Setting;
use yii\web\NotFoundHttpException;

class ConfigController extends \backend\components\Controller
{
    public function actionConfig()
    {
        if (Yii::$app->request->post()) {
            $model = new Setting;
            if ($model->batchSave(Yii::$app->request->post()[$model->formName()]) && $model->updateCache()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('system', 'Save Config Success!'));
                return $this->redirect(['config']);
            }
        } else {
            $models = Setting::find()->where(['is_visible'=>Setting::SETTING_ACTIVE])->all();
            $newModels = [];
            foreach ($models as $model) {
                $newModels[$model->key] = $model;
            }
            
            return $this->render('config', [
                'models' => $newModels,
            ]);
        }
    }
    
    protected function findAuthItemModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
