<?php 
use yii\helpers\Html;
?>
<div class="side_box">
    <?= empty($title)?'':'<h3 class="box_title">'.$title.'</h3>' ?>
    <div class="<?= empty($title)?'list_page':'box_content' ?>">
    	<?= $model->content ?>
    </div>
</div>