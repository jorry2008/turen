<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helpers\General;
use common\models\catalog\Category;
use backend\components\uploadify\UploadifyWidget;
use backend\components\ueditor\UeditorWidget;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\Category */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord) {
    $model->status = true;
}

$parentList = ArrayHelper::merge([0 => Yii::t('catalog','Top Category')], ArrayHelper::map(General::recursiveObj(Category::find()->orderBy(['sort'=>SORT_ASC])->all()), 'id', 'name'));
?>

<div class="row category-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'parent_id')->dropDownList($parentList)?>
        
        <?php 
        echo $form->field($model, 'description')->widget(UeditorWidget::className(), [
            'clientOptions' => [
                'serverUrl' => yii\helpers\Url::to(['ueditor']),
            ],
        ]);
        ?>
        
        <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'image')->widget(UploadifyWidget::className(), ['route'=>'catalog/brand/uploadify', 'dir'=>'category', 'num'=>'1']) ?>
        
        <?php //echo $form->field($model, 'image')->fileInput() ?>
        
        <?= $form->field($model, 'column')->input('number') ?>
        <?= $form->field($model, 'sort')->input('number', ['value'=>50]) ?>
        <?= $form->field($model, 'top')->checkbox() ?>
        <?= $form->field($model, 'status')->checkbox(['value'=>true]) //这里的value值为空，就是与返回的model的相同，所以是选中状态?>
        <?php //echo $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>
        <?php //echo $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
