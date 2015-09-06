<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\cms\DownloadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-download-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'column_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'colorval') ?>

    <?= $form->field($model, 'boldval') ?>

    <?php // echo $form->field($model, 'flag_id') ?>

    <?php // echo $form->field($model, 'file_type') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'accredit') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'run_os') ?>

    <?php // echo $form->field($model, 'down_url') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'link_url') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'picurl') ?>

    <?php // echo $form->field($model, 'picarr') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
