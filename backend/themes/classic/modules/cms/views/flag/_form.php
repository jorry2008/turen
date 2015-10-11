<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\cms\Flag */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord)
	$model->order = 10;
?>

<div class="row cms-flag-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
    	
    	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    	
        <?= $form->field($model, 'flag')->textInput(['maxlength' => true]) ?>
		
	    <?= $form->field($model, 'order')->input('number') ?>
	
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
