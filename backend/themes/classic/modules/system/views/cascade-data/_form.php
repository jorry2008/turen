<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\system\CascadeData;
use backend\assets\Select2Asset;

/* @var $this yii\web\View */
/* @var $model common\models\system\CascadeData */
/* @var $form yii\widgets\ActiveForm */

//加载一插件
Select2Asset::register($this);

$cascadeParentDataUrl = Yii::$app->getUrlManager()->createUrl(['/system/cascade-data/get-cascade-parent-data', 'limit' => 10]);
//使用插件
$this->registerJs("
    $('#system-cascade-parent-data').select2({
        ajax: {
            url: '$cascadeParentDataUrl',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.msg
                };
            },
            cache: true
        }
    });
");
?>

<div class="row cascade-data-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php 
        $dataList = [];
        if(!$model->isNewRecord) {//懒加载
            if($model->parent_id) {
                $dataList = [$model->parent_id => $model->getMySelf()->one()->name];
            } else {
                $dataList = [0 => Yii::t('system', 'Parent Id Is Zero')];
            }
        }
        ?>
        <?php $form = ActiveForm::begin(); ?>
        
        <?php 
        if($model->isNewRecord && !empty($parentModel)) {
        ?>
        <?= $form->field($parentModel, 'id')->label(false)->hiddenInput(['name'=>'CascadeData[parent_id]']) ?>
        <?php } else { ?>
        <?= $form->field($model, 'parent_id')->label(Yii::t('system', 'Parent'))->dropDownList($dataList, ['id'=>'system-cascade-parent-data'])?>
        <?php } ?>
        
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'level')->dropDownList((new CascadeData)->levelArr)?>
        <?= $form->field($model, 'data_group')->dropDownList((new CascadeData)->dataGroupArr)?>
        
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('system', 'Create') : Yii::t('system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
