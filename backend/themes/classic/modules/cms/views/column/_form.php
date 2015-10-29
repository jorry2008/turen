<?php

use yii\base\Object;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\cms\Column;
use kartik\file\FileInput;
use common\helpers\General;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\cms\Column */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
	$('.upload_picture').css(\"cursor\",\"pointer\");
");

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
        
        <?php 
        if($model->isNewRecord) {
        	$model->type = Column::CMS_TYPE_PAGE;
        	echo $form->field($model, 'type')->dropDownList(ArrayHelper::merge(Column::getType(), [Column::CMS_TYPE_STRUCT=>Yii::t('cms', 'Struct')]));
        	echo $form->field($model, 'short_code')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Used for the frontend call.'))->textInput(['maxlength' => true]);
        }
        ?>
        
        <?= $form->field($model, 'parent_id')->dropDownList($parentIds) ?>
		
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        
	    <?= $form->field($model, 'pic_url')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('fileinput', 'Note: Limit upload one picture.'))->widget(FileInput::classname(), [
		    'options'=>[
	    		'accept' => 'image/*',//只接收图片类型
	    		'multiple' => false,//这里不需要多选
	    	],
	    	'pluginOptions' => [
	    		'uploadUrl' => Url::to(['/cms/column/file-upload']),
	    		'uploadAsync' => true,//异步上传
	    		'initialPreview' => General::showImages($model->pic_url),
	    		'initialPreviewConfig' => General::showLinks($model->pic_url, 'pic_url', 'column', '/cms/column/file-upload'),
	    		'previewFileType' => 'any',//预览所有类型文件
	    		//'initialCaption'=>"原有的图片",
	    		'overwriteInitial'=>true,//直接覆盖原有的图片
	    		'maxFileSize' => Yii::$app->params['config']['config_pic_size'],//限制大小
	    		'allowedFileExtensions' => explode(',', Yii::$app->params['config']['config_pic_extension']),//限制后缀名
	    		'allowedFileTypes' => ['image'],//限制文件类型（图片）
	    		'maxFileCount' => 1,//此处限制一张
	    		'uploadExtraData' => [
	    			'dir' => 'column',//目录标识，广告
	    			'name' => 'Column[pic_url]',//指定资源获取标识名
	    			'route' => '/cms/column/file-upload',
	    			'field' => 'pic_url',
	    		],
	    	],
		]) ?>
    
        <?= $form->field($model, 'pic_width')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Unit is pixel,').Yii::t('cms', 'If is blank, default as 100%'))->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'pic_height')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Unit is pixel,').Yii::t('cms', 'If is blank, default as 100%'))->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'link_url')->hint('<i class="fa fa-info-circle"></i> '.Yii::t('cms', 'Click on the column headings first access this link'))->textInput(['maxlength' => true]) ?>
   
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
