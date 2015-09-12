<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\extend\Comment */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
	$model->status = true;
}
?>

<div class="row comment-form">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
			'layout' => 'horizontal',
			'fieldConfig' => [
				'template' => "{label} {beginWrapper} {input} {hint} {error} {endWrapper}",
				'horizontalCssClasses' => [
					'label' => 'col-sm-2',
					'offset' => 'col-sm-offset-2',
					'wrapper' => 'col-sm-8',
					'error' => '',//col-sm-8 col-sm-offset-2
					'hint' => '',//col-sm-8 col-sm-offset-2
				],
			],
		]);
		?>
    
        <?= $form->field($model, 'relative_id')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'mode')->textInput() ?>
	
	    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'reply')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'status')->checkbox()->label($model->getAttributeLabel('status').str_repeat('&nbsp;', 6).'<i class="fa fa-info-circle"></i> '.Yii::t('extend', 'Don\'t show in the frontend,If you don\'t choose')) ?>

	    <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
