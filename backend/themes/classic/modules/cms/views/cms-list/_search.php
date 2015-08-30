<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\cms\CmsListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cms_class_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'colorval') ?>

    <?= $form->field($model, 'boldval') ?>

    <?php // echo $form->field($model, 'cms_flag_id') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'linkurl') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'pic_url') ?>

    <?php // echo $form->field($model, 'picarr') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'updated_at:datetime') ?>

    <?php // echo $form->field($model, 'created_at:datetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
