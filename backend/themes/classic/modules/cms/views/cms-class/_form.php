<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\components\helpers\General;
use common\models\cms\CmsClass;
use yii\base\Object;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsClass */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
    $model->status = true;
    $model->order = 10;
}

//指定了父级栏目
if(isset($id) && $id !== false) {
	$model->parent_id = $id;
}

$parentIds = ArrayHelper::merge(['0'=>Yii::t('cms', 'Top Class')], ArrayHelper::map(General::recursiveObj(CmsClass::find()->orderBy(['order'=>SORT_ASC])->all()), 'id', 'name'));
?>

<div class="row cms-class-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'type')->dropDownList((new CmsClass)->cmsType) ?>
        
        <?= $form->field($model, 'parent_id')->dropDownList($parentIds) ?>
		
        <?php //echo $form->field($model, 'parent_str')->textInput(['maxlength' => true]) ?>
    	
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'link_url')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_width')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_height')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'order')->input('number') ?>
    
        <?= $form->field($model, 'status')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
