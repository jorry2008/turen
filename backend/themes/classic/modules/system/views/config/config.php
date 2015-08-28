<?php

use yii\helpers\Html;
//yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\user\User */

$this->title = Yii::t('user', 'Config Admin');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?php 
        $form = ActiveForm::begin([]);
        ?>
	        <!-- Custom Tabs -->
	        <div class="nav-tabs-custom">
	            <ul class="nav nav-tabs">
	                <li class="active">
	                    <a href="#tab_1" data-toggle="tab"><?php echo Yii::t('system', 'General')?></a>
	                </li>
	                <li>
	                    <a href="#tab_4" data-toggle="tab"><?php echo Yii::t('system', 'Site')?></a>
	                </li>
	                <li>
	                    <a href="#tab_7" data-toggle="tab"><?php echo Yii::t('system', 'Local')?></a>
	                </li>
	                <li>
	                    <a href="#tab_10" data-toggle="tab"><?php echo Yii::t('system', 'Access')?></a>
	                </li>
	                <li>
	                    <a href="#tab_13" data-toggle="tab"><?php echo Yii::t('system', 'Image')?></a>
	                </li>
	                <li>
	                    <a href="#tab_16" data-toggle="tab"><?php echo Yii::t('system', 'Mail')?></a>
	                </li>
	                <li>
	                    <a href="#tab_19" data-toggle="tab"><?php echo Yii::t('system', 'Server')?></a>
	                </li>
	            </ul>
	            
	            <div class="tab-content clearfix" style="padding-top: 30px;">
	                <div class="tab-pane active" id="tab_1">
	                   <?= $this->render('_config/_base', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_4">
	                   <?= $this->render('_config/_site', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_7">
	                   <?= $this->render('_config/_local', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_10">
	                   <?= $this->render('_config/_access', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_13">
	                   <?= $this->render('_config/_pic', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_16">
	                   <?= $this->render('_config/_mail', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <div class="tab-pane" id="tab_19">
	                   <?= $this->render('_config/_server', [
                            'models' => $models,
                        ]) ?>
	                </div>
	                <!-- /.tab-pane -->
	                
	                <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <?= Html::submitButton(Yii::t('common', 'Update'), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
	                
	            </div>
	            <!-- /.tab-content -->
			</div>
		<?php ActiveForm::end(); ?>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
