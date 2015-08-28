<?php
if(isset($models['config_access_action'])) {
    $model = $models['config_access_action'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> index,create.</span>
		</div>
    </div>
</div>
<?php } ?>

<?php
if(isset($models['config_access_controller'])) {
    $model = $models['config_access_controller'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> user/common,customer/customer.</span>
		</div>
    </div>
</div>
<?php } ?>

<?php
if(isset($models['config_access_verb'])) {
    $model = $models['config_access_verb'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> post,get,put.</span>
		</div>
    </div>
</div>
<?php } ?>

<?php
if(isset($models['config_access_ip'])) {
    $model = $models['config_access_ip'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
            <textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> 127.0.0.1,202.15.14.01.</span>
		</div>
    </div>
</div>
<?php } ?>
