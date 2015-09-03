<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\cms\CmsClass;
use common\models\cms\CmsFlag;

use backend\assets\ColorPickerAsset;
// use backend\assets\iCheckAsset;
// use backend\assets\Select2Asset;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsList */
/* @var $form yii\widgets\ActiveForm */

//注入相关插件
ColorPickerAsset::register($this);
// iCheckAsset::register($this);
// Select2Asset::register($this);

if($model->isNewRecord) {
	$model->status = true;
	$model->hits = 100;
	$model->author = Yii::$app->getUser()->identity->username;
} else {
	$titleOptions = ['style'=>''];
	Html::addCssStyle($titleOptions, ['color'=>$model->colorval, 'font-weight'=>$model->boldval]);
}

$this->registerJs("
// 	$('input[type=\"checkbox\"].minimal, input[type=\"radio\"].minimal').iCheck({
// 		checkboxClass: 'icheckbox_minimal-blue',
// 		radioClass: 'icheckbox_minimal-blue'
// 	});
	
	//select2
// 	$('#cmslist-cms_class_id').select2({
//         theme: 'classic',
//         width: '400px',
//     });

	var title = $('#cmslist-title');
	var colorval = $('#cmslist-colorval');
	var boldval = $('#cmslist-boldval');
	$('.title-colorpicker').colorpicker().on('changeColor', function(obColor){
		var weight = title.css('font-weight');
		title.css({\"color\": obColor.color.toHex(), \"font-weight\": weight});
		colorval.val(obColor.color.toHex());
	});
	$('.field-cmslist-title').on('click' ,'.blod', function(){
		var color = title.css('color');
		var bold = title.css('font-weight');
		bold = (bold == '700')?'400':'700';
		title.css({\"color\": color, \"font-weight\": bold});
		boldval.val(bold);
	}).on('click' ,'.clear', function(){
		title.css({\"color\": '#333', \"font-weight\": '400'});
		colorval.val('#333');
		boldval.val('400');
	});
		
");
?>

<div class="row cms-list-form">
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
    	
        <?= $form->field($model, 'cms_class_id')->dropDownList(ArrayHelper::map(CmsClass::find()->where(['type'=>CmsClass::CMS_TYPE_LIST])->alive()->all(), 'id', 'name')) ?>
	
	    <?php 
	    //局部布局
	    echo $form->field($model, 'title', [
// 	    	'inputOptions' => [
// 	    		'placeholder' => $model->getAttributeLabel('title'),
// 	    	],
// 			'template' => '{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div>',
	    	'horizontalCssClasses' => [
				'wrapper' => 'col-sm-8',
			],
	    	'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><span class="color title-colorpicker" title="'.Yii::t('cms', 'Title Color').'"></span> <span class="blod" title="'.Yii::t('cms', 'Title Bold').'"></span> <span class="clear" title="'.Yii::t('cms', 'Clear').'">#</span></span></div>',
    	])->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Title is required'), ['class'=>'help-block error-none'])->textInput(['maxlength' => true, 'style'=>!empty($titleOptions)?$titleOptions['style']:'']);//直接对长度限制
	    ?>
	    
	    <?= Html::activeHiddenInput($model, 'colorval') ?>
	    <?= Html::activeHiddenInput($model, 'boldval') ?>
	
	    <?= $form->field($model, 'cms_flag_id')->inline()->checkboxList(ArrayHelper::map(CmsFlag::find()->orderBy('order')->alive()->all(), 'id', 'name')) ?>
	
	    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'linkurl')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'keywords')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'With a blank or ", "between multiple keywords'), ['class'=>'help-block error-none'])->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 3]) ?>
	
	    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'picarr')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'hits')->input('number', ['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'created_at', [
	    	'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-clock-o"></i></span></div>',
	    ])->textInput() ?>
	
	    <?= $form->field($model, 'status')->checkbox()->label($model->getAttributeLabel('status').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Don\'t show in the frontend,If you don\'t choose')) ?>

        <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
