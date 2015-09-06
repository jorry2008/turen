<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\cms\Ad;
use common\models\cms\AdType;

/* @var $this yii\web\View */
/* @var $model common\models\cms\Ad */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
	$model->status = true;
}
?>

<div class="row cms-ad-form">
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
    
        <?= $form->field($model, 'ad_type_id')->dropDownList(ArrayHelper::map(AdType::find()->alive()->all(), 'id', 'name')) ?>
        
        <?= $form->field($model, 'mode')->dropDownList(Ad::getAdMode()) ?>

	    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'link_url')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Site address, please fill in the  http:// beginning'))->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order')->input('number') ?>
	    
	    <?= $form->field($model, 'status')->checkbox()->label($model->getAttributeLabel('status').str_repeat('&nbsp;', 6).'<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Don\'t show in the frontend,If you don\'t choose')) ?>

        <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
