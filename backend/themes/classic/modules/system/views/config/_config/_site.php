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
<span style="display: none;">config_site_title_length</span>
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
			<span class="help-block"><?= Yii::t('system', 'Example:')?> <?= Yii::t('system', 'Number of direct interception length of Chinese characters or letters')?></span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_default_hits</span>
<?php } ?>

<?php 
if(isset($models['config_site_default_page_size'])) { 
$model = $models['config_site_default_page_size'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 前台列表分页大小</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_default_page_size</span>
<?php } ?>

<?php 
if(isset($models['config_site_keywords'])) { 
$model = $models['config_site_keywords'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> <?= Yii::t('system', 'SEO Keywords') ?></span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_keywords</span>
<?php } ?>

<?php 
if(isset($models['config_site_description'])) { 
$model = $models['config_site_description'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> <?= Yii::t('system', 'SEO Description') ?></span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_description</span>
<?php } ?>

<?php 
if(isset($models['config_site_contact_phone'])) { 
$model = $models['config_site_contact_phone'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<input type="text" name="Setting[<?= $model->key ?>]" value="<?= $model->value ?>" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5">
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 13725514524</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_contact_phone</span>
<?php } ?>

<?php 
if(isset($models['config_site_contact_tel'])) { 
$model = $models['config_site_contact_tel'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 400-850-100/400-850-100,400-850-101</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_contact_tel</span>
<?php } ?>

<?php 
if(isset($models['config_site_contact_qq'])) { 
$model = $models['config_site_contact_qq'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 980522557/980522557,9898989898</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_contact_qq</span>
<?php } ?>

<?php 
if(isset($models['config_site_shouhou_qq'])) { 
$model = $models['config_site_shouhou_qq'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> 980522557/980522557,9898989898</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_shouhou_qq</span>
<?php } ?>

<?php 
if(isset($models['config_site_tongji_pc'])) { 
$model = $models['config_site_tongji_pc'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> xxxxx</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_tongji_pc</span>
<?php } ?>

<?php 
if(isset($models['config_site_tongji_m'])) { 
$model = $models['config_site_tongji_m'];
?>
<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="<?= $model->key ?>"><?= $model->name ?></label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<textarea rows="" cols="" name="Setting[<?= $model->key ?>]" placeholder="" id="<?= $model->key ?>" class="form-control col-md-5"><?= $model->value ?></textarea>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?= Yii::t('system', 'Example:')?> xxxxx</span>
		</div>
    </div>
</div>
<span style="display: none;">config_site_tongji_m</span>
<?php } ?>






