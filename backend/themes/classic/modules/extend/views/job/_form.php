<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\extend\Job */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
	$model->status = true;
	$model->order = 10;
}
?>

<div class="row job-form">
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
    
		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'num')->textInput() ?>
	
	    <?= $form->field($model, 'sex')->textInput() ?>
	
	    <?= $form->field($model, 'treatment')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'usefullife')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'workdesc')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'post_time')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order')->input('number', ['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'status')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('common', 'Don\'t show in the frontend,If you don\'t choose'))->radioList([1=>Yii::t('common', 'Yes'), 0=>Yii::t('common', 'No')]) ?>
		
	    <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
