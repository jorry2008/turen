<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\components\helpers\General;
use common\models\cms\Column;
use yii\base\Object;

/* @var $this yii\web\View */
/* @var $model common\models\cms\Column */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
    $model->status = true;
    $model->order = 10;
}

//指定了父级栏目
if(isset($id) && $id !== false) {
	$model->parent_id = $id;
}

$parentIds = ArrayHelper::merge(['0'=>Yii::t('cms', 'Top Column')], ArrayHelper::map(General::recursiveObj(Column::find()->orderBy(['order'=>SORT_ASC])->all()), 'id', 'name'));
?>

<div class="row cms-class-form">
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
        
        <?= $form->field($model, 'type')->dropDownList(Column::getType()) ?>
        
        <?= $form->field($model, 'parent_id')->dropDownList($parentIds) ?>
		
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_width')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Unit is pixel,').Yii::t('cms', 'If is blank, default as 100%'))->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_height')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Unit is pixel,').Yii::t('cms', 'If is blank, default as 100%'))->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'link_url')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Click on the column headings first access this link'))->textInput(['maxlength' => true]) ?>
   
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
