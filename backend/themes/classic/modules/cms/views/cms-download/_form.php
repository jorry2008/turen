<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsDownload */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row cms-download-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'cms_class_id')->textInput() ?>
	
	    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'colorval')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'boldval')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'cms_flag_id')->textInput() ?>
	
	    <?= $form->field($model, 'file_type')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'accredit')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'file_size')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'run_os')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'down_url')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'link_url')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'picurl')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'picarr')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'hits')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'status')->textInput() ?>
	
	    <?= $form->field($model, 'deleted')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
