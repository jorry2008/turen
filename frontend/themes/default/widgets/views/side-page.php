<?php 
use yii\helpers\Html;
?>
<div id="side-page" class="side_box">
    <?= empty($title)?'':'<h3 class="box_title">'.$title.'</h3>' ?>
    <div class="<?= empty($title)?'list_page':'box_content' ?>">
    	<ul>
    		<?php 
	    	foreach ($models as $model) {
	    		$active = (Yii::$app->getRequest()->get('name', '') == $model->short_code);
	    		echo '<li class="'.($active?'on':'off').'">'.Html::a($model->name, ['/site/page/view', 'name'=>$model->short_code]).'</li>';
	    	}
	    	?>
    	</ul>
    </div>
</div>