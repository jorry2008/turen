<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="frontLanguage">前台语言</label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<?php //echo CHtml::dropDownList('config_local_front_language', Yii::app()->config->get('config_front_language'), $language, array('class'=>'form-control col-md-5')); ?>
        </div>
        <div class="col-md-7">
			<span class="help-block">Example block-level help text here.</span>
		</div>
    </div>
</div>
<span style="display: none;">config_local_front_language</span>

<div class="form-group clearfix">
    <label class="col-md-2 text-right form-label" for="frontLanguage">后台语言</label>
    <div class="col-md-10">
        <div class="col-md-7">
        	<?php //echo CHtml::dropDownList('config_local_back_language', Yii::app()->config->get('config_back_language'), $language, array('class'=>'form-control col-md-5')); ?>
        </div>
        <div class="col-md-7">
			<span class="help-block"><?=Yii::t('system', 'Example:')?> block-level help text here.</span>
		</div>
    </div>
</div>
<span style="display: none;">config_local_back_language</span>

