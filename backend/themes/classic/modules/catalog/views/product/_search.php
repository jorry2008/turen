<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'is_best') ?>

    <?php // echo $form->field($model, 'is_free_shipping') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'stock_status') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'shipping') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'shop_price') ?>

    <?php // echo $form->field($model, 'is_promote') ?>

    <?php // echo $form->field($model, 'promote_price') ?>

    <?php // echo $form->field($model, 'promote_start_date') ?>

    <?php // echo $form->field($model, 'promote_end_date') ?>

    <?php // echo $form->field($model, 'points') ?>

    <?php // echo $form->field($model, 'tax_class_id') ?>

    <?php // echo $form->field($model, 'date_available') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'mini_mum') ?>

    <?php // echo $form->field($model, 'viewed') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('catalog', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('catalog', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
