<?php

use yii\helpers\Html;
use backend\assets\BackendAsset;

/* @var $this \yii\web\View */
/* @var $content string */

BackendAsset::register($this);

//方法一：
$baseUrl = (new BackendAsset)->baseUrl;
//方法二：
//fb($this->context->baseUrl);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' - '.Yii::t('common', Yii::$app->name)) ?></title>
    <?php $this->head() ?>
</head>

<body class="login-page">
    <?php $this->beginBody() ?>
        
        <div class="login-box">
        <div style="margin:0 -10px;">
        <?php 
		if(!empty(Yii::$app->getSession()->getFlash('danger'))) {
            echo '<div class="box-body"><div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i>'.Yii::$app->getSession()->getFlash('danger').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
        } elseif (!empty(Yii::$app->getSession()->getFlash('info'))) {
            echo '<div class="box-body"><div class="alert alert-info alert-dismissable"><i class="icon fa fa-info"></i>'.Yii::$app->getSession()->getFlash('info').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
        } elseif (!empty(Yii::$app->getSession()->getFlash('warning'))) {
            echo '<div class="box-body"><div class="alert alert-warning alert-dismissable"><i class="icon fa fa-warning"></i>'.Yii::$app->getSession()->getFlash('warning').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
        } elseif (!empty(Yii::$app->getSession()->getFlash('success'))) {
            echo '<div class="box-body"><div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i>'.Yii::$app->getSession()->getFlash('success').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
        }
		?>
        </div>
        
        <?= $content ?>
        </div>
        <!-- ./wrapper -->
    
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
