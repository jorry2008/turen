<?php
/**
 * list项展示样式
 * 
 */

use yii\helpers\Html;  
use yii\helpers\HtmlPurifier;  
use yii\helpers\StringHelper;

use common\helpers\General;
?>

<?php 
//$model, $key, $index, $widget
//Html::encode($model->title)
$length = 28;//标题截取长度
$dlength = 82;
?>

<div class="list">
	<?php //这里可以考虑从content中获取图片 ?>
    <?= Html::a(General::showImg($model->pic_url, 'c', $model->title, 'px', 140, 102), ['/site/img/view', 'id'=>$model->id], ['class'=>'img' ,'title'=>$model->title]) ?>
    <div class="list_detail">
    	<?php 
    	$options = ['style'=>''];
    	if(!empty($model->colorval) || !empty($model->boldval)) {
    		Html::addCssStyle($options, ['color'=>$model->colorval, 'font-weight'=>$model->boldval]);
    	}
    	?>
    	<?= Html::a(StringHelper::truncate($model->title, $length), ['/site/img/view', 'id'=>$model->id], ['class'=>'title', 'title'=>$model->title, 'style'=>$options['style']]) ?>
        
        <div class="cont">
        	<?php
        	if(empty($model->description)) {
        		$des = $model->content;//去除图片链接
        	} else {
        		$des = $model->description;
        	}
        	echo StringHelper::truncate(strip_tags($des), $dlength);
        	?>
            <?= Html::a('详情', ['/site/img/view', 'id'=>$model->id], ['rel'=>'nofollow']) ?>
        </div>
        
        <div class="ft clearfix">
            <span class="fl">[<?= Html::encode($columnModel->name) ?>]</span>
            <div class="fr">
                <span class="date"><?= Yii::$app->getFormatter()->asDate($model->publish_at) ?></span>
                <span>浏览数：<?= $model->hits ?></span>
            </div>
        </div>
    </div>
</div>
