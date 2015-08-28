<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
// use yii\imagine\Image;
use backend\components\uploadify\UploadifyWidget;
use backend\components\ueditor\UeditorWidget;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\Brand */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord) {
    $model->status = true;
    $model->sort = 50;
}
?>

<div class="row brand-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?php //echo $form->field($model, 'desc')->textarea(['rows' => 6]) ?>
        
        <?php 
        echo $form->field($model, 'desc')->widget(UeditorWidget::className(), [
            'clientOptions' => [
                'serverUrl' => yii\helpers\Url::to(['ueditor']),
            ],
        ]);
        ?>
        
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'image')->widget(UploadifyWidget::className(), ['route'=>'catalog/brand/uploadify', 'dir'=>'brand', 'num'=>'1']) ?>
        
        <?= $form->field($model, 'sort')->input('number') ?>
        <?= $form->field($model, 'status')->checkbox(['value'=>true]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
