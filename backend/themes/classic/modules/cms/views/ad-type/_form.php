<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\cms\AdType;

/* @var $this yii\web\View */
/* @var $model common\models\cms\AdType */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord) {
	$model->status = true;
}
?>

<div class="row cms-ad-type-form">
    <div class="col-md-12">
        <?php 
		//广泛布局
		$form = ActiveForm::begin([
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
	
	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'short_code')->textInput() ?>
	    
	    <?= $form->field($model, 'wh_type')->dropDownList([AdType::WH_TYPE_PX=>Yii::t('cms', 'Pixel'), AdType::WH_TYPE_PERCENT=>Yii::t('cms', 'Percent')]) ?>
	
	    <?= $form->field($model, 'width')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'If is blank, default as 100%'))->input('number') ?>
	
	    <?= $form->field($model, 'height')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'If is blank, default as 100%'))->input('number') ?>
	
	    <?= $form->field($model, 'status')->checkbox()->label($model->getAttributeLabel('status').str_repeat('&nbsp;', 6).'<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Don\'t show in the frontend,If you don\'t choose')) ?>

        <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
