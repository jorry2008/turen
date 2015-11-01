<?php 
/**
 * jorry<980522557@qq.com>
 * 
 */
use yii\helpers\StringHelper;
use yii\helpers\Html;
?>
<div class="side_box">
    <?= empty($title)?'':'<h3 class="box_title">'.$title.'</h3>' ?>
    <div class="<?= empty($title)?'list_page':'box_content' ?>">
    	<ul>
	    	<?php 
	    	foreach ($models as $model) {
	    		echo '<li><i class="list_i"></i>'.Html::a(StringHelper::truncate($model->title, $length), ['/site/post/view', 'id'=>$model->id]).'</li>';
	    	}
	    	?>
    	</ul>
    </div>
</div>