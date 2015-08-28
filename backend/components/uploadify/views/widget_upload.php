<?php

// use yii\helpers\Html;
//use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\BrandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary box-solid">
<div class="box-header with-border">
    <h3 class="box-title"><?php echo Yii::t('uploadify', 'Image Show')?></h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body">
    <ul id="file_list" class="clearfix">
    <?php 
    if(trim($model->{$attribute})) {
        $files = explode(',', $model->{$attribute});
        if(!empty($files)) {
            foreach ($files as $file) {
            $imgUrl = $baseUrl.$file;
    ?>
        <li rel="<?= $imgUrl?>">
            <img height="140px" src="<?= $imgUrl?>">
            <a href="javascript:void(0);" class="delete" data-url="<?= $imgUrl?>" ><?= Yii::t('uploadify', 'Delete')?></a>
        </li>
    <?php 
            }
        } else {
            echo Yii::t('uploadify', 'Not Found Anything!');
        }
    }
    ?>
    </ul>
    
    <div style="margin-top:10px;">
        <a class="btn btn-primary <?php echo $btnClassName?>" data-widget="<?php echo $widgetId;?>" data-frame="<?php echo $attribute.'_frame';?>" data-dir="<?php echo $dir; ?>" data-num="<?php echo $num; ?>" data-url="<?php echo Yii::$app->getUrlManager()->createUrl($route);?>">
            <i class="fa fa-file-image-o"></i> <?php echo Yii::t('uploadify', 'Add')?>
        </a>
    </div>
    </div>
</div>
