<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use backend\components\ueditor\UeditorWidget;
use backend\components\uploadify\UploadifyWidget;

use yii\helpers\ArrayHelper;
use common\helpers\General;
use common\models\catalog\Category;
use common\models\catalog\Brand;

use backend\assets\DatePickerAsset;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\Product */
/* @var $form yii\widgets\ActiveForm */

//加载一插件
DatePickerAsset::register($this);

//使用插件
$this->registerJs("
	$('#product-promote_start_date, #product-promote_end_date').datepicker({
        language: '".Yii::$app->language."',//使用当前语言
	    format: 'yyyy/mm/dd'
	});
");
$model->promote_start_date = Yii::$app->getFormatter()->asDate($model->promote_start_date, 'yyyy/MM/dd');//与js配合
$model->promote_end_date = Yii::$app->getFormatter()->asDate($model->promote_end_date, 'yyyy/MM/dd');//与js配合

$cateList = ArrayHelper::map(General::recursiveObj(Category::find()->orderBy(['sort'=>SORT_ASC])->all()), 'id', 'name');
$brandList = ArrayHelper::map(Brand::find()->orderBy(['sort'=>SORT_ASC])->all(), 'id', 'name');
?>

<!-- 导航 -->
<div id="product_nav">
    <ul>
        <li><a href="#home"><?= Yii::t('catalog', 'Base')?></a></li>
        <li><a href="#declare"><?= Yii::t('catalog', 'Declare')?></a></li>
        <li><a href="#price"><?= Yii::t('catalog', 'Price')?></a></li>
        <li><a href="#ship"><?= Yii::t('catalog', 'Ship')?></a></li>
        <li><a href="#prom"><?= Yii::t('catalog', 'Promotion')?></a></li>
    </ul>
</div>

<div class="row product-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-8">
        <?php $form = ActiveForm::begin(); ?>
        
        <h3><?= Yii::t('catalog', 'Base Information')?></h3>
        <?php //echo $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'type')->textInput() ?>
        <?= $form->field($model, 'category_id')->dropDownList($cateList) ?>
        <?= $form->field($model, 'brand_id')->dropDownList($brandList) ?>
        <?= $form->field($model, 'mini_mum')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'brief')->textarea(['maxlength' => true]) ?>
        <?php 
        echo $form->field($model, 'description')->widget(UeditorWidget::className(), [
            'clientOptions' => [
                'serverUrl' => yii\helpers\Url::to(['ueditor']),
            ],
        ]);
        ?>
        <?= $form->field($model, 'image')->widget(UploadifyWidget::className(), ['route'=>'catalog/product/uploadify', 'dir'=>'product', 'num'=>'6']) ?>
        <?= $form->field($model, 'date_available')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tax_class_id')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')->input('number') ?>
        <?= $form->field($model, 'status')->checkbox() ?>
        
        
        <?php //锚点?>
        <a name="declare" id="mark_price"></a>
        <h3 class="mark_"><?= Yii::t('catalog', 'Product Declare')?></h3>
        <div>
        <?= $form->field($model, 'exemption_amount')->textInput() ?>
        <?= $form->field($model, 'regulatory_category_mark')->textInput() ?>
        <?= $form->field($model, 'brand_country')->textInput() ?>
        <?= $form->field($model, 'origin_country')->textInput() ?>
        <?= $form->field($model, 'manu_facture')->textInput() ?>
        <?= $form->field($model, 'unit')->textInput() ?>
        <?= $form->field($model, 'basis')->textInput() ?>
        <?= $form->field($model, 'upc')->textInput() ?>
        <?= $form->field($model, 'declare_category')->textInput() ?>
        <?= $form->field($model, 'declare_value')->textInput() ?>
        <?= $form->field($model, 'declare_name')->textInput() ?>
        <?= $form->field($model, 'tax_rate')->textInput() ?>
        <?= $form->field($model, 'tax_code')->textInput() ?>
        <?= $form->field($model, 'hs_code')->textInput() ?>
        </div>
        
        <?php //锚点?>
        <a name="price" id="mark_price"></a>
        <h3 class="mark_"><?= Yii::t('catalog', 'Product Price')?></h3>
        <?= $form->field($model, 'price')->input('number') ?>
        <?= $form->field($model, 'market_price')->input('number') ?>
        <?= $form->field($model, 'shop_price')->input('number') ?>
        
        <?php //锚点?>
        <a name="ship" id="mark_ship"></a>
        <h3 class="mark_"><?= Yii::t('catalog', 'Product Shipping')?></h3>
        <?= $form->field($model, 'shipping')->checkbox() ?>
        <?= $form->field($model, 'weight')->input('number') ?>
        <?= $form->field($model, 'length')->input('number') ?>
        <?= $form->field($model, 'width')->input('number') ?>
        <?= $form->field($model, 'height')->input('number') ?>
        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'quantity')->input('number') ?>
        <?= $form->field($model, 'stock_status')->textInput(['maxlength' => true]) ?>
        
        <?php //锚点?>
        <a name="prom" id="mark_prom"></a>
        <h3 class="mark_"><?= Yii::t('catalog', 'Product Promotion')?></h3>
        <div class="form-group field-product-is_hot">
            <div class="checkbox">
                <?php 
                echo Html::activeCheckbox($model, 'is_hot');
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo Html::activeCheckbox($model, 'is_new');
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo Html::activeCheckbox($model, 'is_best');
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo Html::activeCheckbox($model, 'is_free_shipping');
                echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                echo Html::activeCheckbox($model, 'is_promote');
                ?>
            </div>
        </div>
        <?= $form->field($model, 'promote_price')->input('number') ?>
        <?= $form->field($model, 'promote_start_date')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'promote_end_date')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'points')->input('number') ?>
        <?= $form->field($model, 'viewed')->input('number') ?>
        
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
