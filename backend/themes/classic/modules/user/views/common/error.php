<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-12">

<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>上述Web服务器正在处理您的请求时发生错误。</p>
    <p>请联系我们如果你认为这是一个服务器错误。谢谢你！</p>

</div>

</div>
</div>
