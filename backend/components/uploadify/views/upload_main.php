<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

//方法一：
// $baseUrl = (new BackendAsset)->baseUrl;
//方法二：
//fb($this->context->baseUrl);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' - '.Yii::t('uploadify', Yii::$app->name)) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <?= $content ?>
    
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
