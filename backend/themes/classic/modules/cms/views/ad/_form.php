<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use common\models\cms\Ad;
use common\models\cms\AdType;
use kartik\file\FileInput;
use common\helpers\General;

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
	    
	    <?= $form->field($model, 'pic_url')->widget(FileInput::classname(), [
		    'options'=>[
	    		'accept' => 'image/*',//只接收图片类型
	    		'multiple' => false,//这里不需要多选
	    	],
	    	'pluginOptions' => [
	    		'uploadUrl' => Url::to(['/cms/ad/file-upload']),
	    		'uploadAsync' => true,//异步上传
	    		'initialPreview' => General::showImages($model->pic_url),
	    		'initialPreviewConfig' => General::showLinks($model->pic_url, 'pic_url', 'ad', '/cms/ad/file-upload'),
	    		'previewFileType' => 'any',//预览所有类型文件
	    		//'initialCaption'=>"原有的图片",
	    		'overwriteInitial'=>true,//直接覆盖原有的图片
	    		'maxFileSize' => Yii::$app->params['config']['config_pic_size'],//限制大小
	    		'allowedFileExtensions' => explode(',', Yii::$app->params['config']['config_pic_extension']),//限制后缀名
	    		'allowedFileTypes' => ['image'],//限制文件类型（图片）
	    		'maxFileCount' => 1,//此处限制一张
	    		'uploadExtraData' => [
	    			'dir' => 'ad',//目录标识，广告
	    			'name' => 'Ad[pic_url]',//指定资源获取标识名
	    			'route' => '/cms/ad/file-upload',
	    			'field' => 'pic_url',
	    		],
	    	],
		]) ?>
	    
	    <?php /*
	    FileInput::widget([
	    	'name' => 'pic_url',
	    	'options'=>[
	    		'accept' => 'image/*',//只接收图片类型
	    		'multiple'=>false,//这里不需要多选
	    	],
	    	'pluginOptions' => [
	    		'uploadUrl' => Url::to(['/cms/ad/file-upload']),
// 	    		'uploadAsync' => true,//异步上传
	    		'initialPreview'=>[
	    			//Html::img("/images/moon.jpg", ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
	    		],
	    		'previewFileType' => 'any',//预览所有类型文件
	    		//'initialCaption'=>"原有的图片",
	    		'overwriteInitial'=>true,//直接覆盖原有的图片
	    		'maxFileSize' => Yii::$app->params['config']['config_pic_size'],//限制大小
	    		'allowedFileExtensions' => explode(',', Yii::$app->params['config']['config_pic_extension']),//限制后缀名
	    		'allowedFileTypes' => ['image'],//限制文件类型（图片）
	    		'maxFileCount' => 1,//此处限制一张
//     			'showPreview' => true,//显示预览
//     			'showCaption' => true,//显示标题
//     			'showRemove' => true,//显示删除按钮
//     			'showUpload' => true,//显示上传按钮
	    		//'elCaptionText' => '#customCaption',//target错误位置
	    		'uploadExtraData' => [
	    			'dir' => 'ad',//目录标识，广告
	    			'name' => 'Ad[pic_url]',//指定资源获取标识名
	    			'route' => '/cms/ad/file-upload',
	    		],
	    	],
	    	'pluginEvents' => [//各种事件回写
	    		'fileuploaded' => 'function(event, data, previewId, index) {//文件上传之后响应
	    			//console.debug(event);
	    			//console.debug(data.files);
	    			var dir = data.extra.dir;
	    			var date_ = "2015-10";
	    			var name = data.extra.name;
	    			//var route = data.extra.route;
	    			var input = $(":input[name=\'"+name+"\']");
	    			var val = input.val();//原值
	    			
	    			for(var i=0;i<data.files.length;i++){
	    				var name = data.files[i].name;
	    				if(val == "") {
	    					val = dir+"/"+date_+"/"+name;
	    				} else {
							val = val+","+dir+"/"+date_+"/"+val;
	    				}
					}
	    			
	    			//console.debug(val);
	    			input.val(val);
	    			//console.debug(input);
	    			//console.debug(input.val());
	    			//console.debug(previewId);
	    			//console.debug(index);
				}',
	    		'filedeleted' => 'function() {//文件删除之后响应
	    			console.debug(\'删除了\');
				}',
	    	],
		]) 
		*/
		?>
		
	    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
	
	    <?= $form->field($model, 'link_url')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Site address, please fill in the  http:// beginning'))->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'order')->input('number') ?>
	    
	    <?= $form->field($model, 'status')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('common', 'Don\'t show in the frontend,If you don\'t choose'))->radioList([1=>Yii::t('common', 'Yes'), 0=>Yii::t('common', 'No')]) ?>
	    
        <div class="form-group">
	        <div class="col-sm-8 col-sm-offset-2">
	        	<?= Html::submitButton($model->isNewRecord ? Yii::t('cms', 'Create') : Yii::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
