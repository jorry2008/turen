<?php
if(isset($models['config_pic_extension'])) {
    $model = $models['config_pic_extension'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> jpg,png,gif</span>
		</div>
    </div>
</div>
<span style="display: none;">config_pic_extension</span>
<?php } ?>

<?php
if(isset($models['config_pic_size'])) {
    $model = $models['config_pic_size'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> <?php echo Yii::t('system', 'Accepts units KB')?></span>
		</div>
    </div>
</div>
<span style="display: none;">config_pic_size</span>
<?php } ?>

<?php
if(isset($models['config_pic_url'])) {
    $model = $models['config_pic_url'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> http://img0.baidu.com</span>
		</div>
    </div>
</div>
<span style="display: none;">config_pic_url</span>
<?php } ?>

<?php 
if(isset($models['config_pic_no_picture'])) { 
$model = $models['config_pic_no_picture'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> common/no_picture.png</span>
		</div>
    </div>
</div>
<span style="display: none;">config_pic_no_picture</span>
<?php } ?>

<?php
if(isset($models['config_pic_quality'])) {
    $model = $models['config_pic_quality'];
    ?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> 1~100</span>
		</div>
    </div>
</div>
<span style="display: none;">config_pic_quality</span>
<?php } ?>




