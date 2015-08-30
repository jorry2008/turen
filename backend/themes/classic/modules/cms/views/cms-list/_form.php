<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\cms\CmsClass;
use common\models\cms\CmsFlag;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsList */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
	$model->status = true;
	$model->hits = 100;
}
?>

<div class="row cms-list-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
    	
        <?= $form->field($model, 'cms_class_id')->dropDownList(ArrayHelper::map(CmsClass::find()->where(['type'=>CmsClass::CMS_TYPE_LIST])->alive()->all(), 'id', 'name')) ?>
	
	    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'colorval')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'boldval')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'cms_flag_id')->dropDownList(ArrayHelper::map(CmsFlag::find()->orderBy('order')->all(), 'id', 'name')) ?>
	
	    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'linkurl')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'picarr')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'hits')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'status')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
