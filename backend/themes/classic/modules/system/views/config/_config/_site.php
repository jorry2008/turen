<?php 
if(isset($models['config_site_title_length'])) { 
$model = $models['config_site_title_length'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> <?= Yii::t('system', 'Number of direct interception length of Chinese characters or letters')?></span>
		</div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($models['config_site_default_hits'])) { 
$model = $models['config_site_default_hits'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 100</span>
		</div>
    </div>
</div>
<?php } ?>




