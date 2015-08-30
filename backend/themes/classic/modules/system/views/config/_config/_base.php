<?php 
if(isset($models['config_site_name'])) { 
$model = $models['config_site_name'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> 土人官方网站</span>
		</div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($models['config_site_owner'])) { 
$model = $models['config_site_owner'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> Administor</span>
		</div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($models['config_address'])) { 
$model = $models['config_address'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> 南山科技园</span>
		</div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($models['config_email'])) { 
$model = $models['config_email'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> administor@turen.com</span>
		</div>
    </div>
</div>
<?php } ?>

<?php 
if(isset($models['config_tel'])) { 
$model = $models['config_tel'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> 110</span>
		</div>
    </div>
</div>
<?php } ?>

        
        
		


