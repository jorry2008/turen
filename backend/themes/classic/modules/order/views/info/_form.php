<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\order\Info */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row info-form">
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
    
		<?= $form->field($model, 'order_no')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'consignee')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'country')->textInput() ?>
	
	    <?= $form->field($model, 'province')->textInput() ?>
	
	    <?= $form->field($model, 'city')->textInput() ?>
	
	    <?= $form->field($model, 'district')->textInput() ?>
	
	    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order_note')->textarea(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order_amount')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'cms_ad_id')->textInput() ?>
	
	    <?= $form->field($model, 'referer')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'add_time')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'confirm_time')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'payment_time')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'payment_note')->textarea(['maxlength' => true]) ?>

	    <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
