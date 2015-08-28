<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\cms\CmsClass;
use common\components\helpers\General;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsPage */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord) {
    $model->status = true;
    $model->order = 10;
}
//type = 0为单页
//$items = ArrayHelper::map(General::recursiveObj(CmsClass::find()->where(['type'=>0])->orderBy(['order'=>SORT_ASC])->all()), 'id', 'name');
?>

<div class="row cms-page-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        
        <?php //echo $form->field($model, 'cms_class_id')->dropDownList($items) ?>
        <?php //echo $form->field($model, 'cmsClass.name')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    
        <?= $form->field($model, 'order')->input('number') ?>
    
        <?= $form->field($model, 'status')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
