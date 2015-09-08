<?php
/* @var $this RoleController */
/* @var $model AuthItem */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\auth\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('auth', 'Auth Operation');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
$this->registerJs("
	jQuery(document).on('click','#role_box input:checkbox',function() {
		var type = $(this).attr('data-type');
		var name_ = $(this).val();
		var val = $(this).is(\":checked\");
		if(type == 'task') {
			jQuery(\"input[name=\'\"+name_+\"\[\]\']:enabled\").each(function() {this.checked=val;});
		} else if(type == 'operation') {
			$(this).parents('.box.box-solid').find('.task_on').attr('checked', false);
		}
	});
");
?>

<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
               <li>
                   <?= Html::a(Yii::t('common', 'Index'), ['index']) ?>
               </li>
               <li class="active">
                   <?= Html::a(Yii::t('auth', 'Auth'), 'javascript:;') ?>
               </li>
            </ul>
            
            <div class="tab-content clearfix">
                <div id="role_box" class="tab-pane active auth-config">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            
                            <!-- <p><?= Html::a(Yii::t('auth', 'Create Auth Item'), ['create'], ['class' => 'btn btn-success']) ?></p> -->
                            
                            <?php $form = ActiveForm::begin([
                                'method' => 'post',
                                'action' => ['config', 'name'=>$name],
                            ]); ?>
                            
                            <div class="box-body">
							    <table class="table table-bordered">
							        <tbody>
							            <tr>
							                <th style="width: 170px">全选/取消</th>
							                <th>权限节点</th>
							            </tr>
							            
							            <?php 
			            	            if(count($tasksAndPermissions) > 0) {
			            	            	foreach ($tasksAndPermissions as $key => $value) {
			                                    
			            	            		$task = $value['task'];
			            	            		$permissions = $value['permissions'];
			            	            ?>
							            <tr>
							                <td>
							                	<label for="<?=$task->name?>">
							                    <?php echo Html::checkBox($task->name.'[]', in_array($task->name, $selectItems), array('id'=>$task->name, 'class'=>'task_on', 'value'=>$task->name, 'data-type'=>'task'));?>
                                    			<span><?=Yii::t('common', $task->description)?></span>
                                    			<?php //echo Html::label(Yii::t('common', $task->description), $task->name);?>
                                    			</label>
							                </td>
							                <td class="tr_body">
												<?php 
												foreach ($permissions as $operation) {
													echo '<label for="'.$operation->name.'">';
													echo Html::checkBox($task->name.'[]', (in_array($task->name, $selectItems) || in_array($operation->name, $selectItems)), array('id'=>$operation->name, 'class'=>'operation_on', 'value'=>$operation->name, 'data-type'=>'operation'));
													echo '<span>'.Yii::t('common', $operation->description).'</span>';
// 													echo Html::label(Yii::t('common', $operation->description), $operation->name);
													echo '</label>';
												}
												?>
							                </td>
							            </tr>
							            <?php 
			            	            	}
			            	            }
			            	            ?>
							            
							        </tbody>
							    </table>
							</div>
            	            
            	            <div class="row">
                	            <div class="form-group" style="margin-left: 2em">
                                    <?= Html::submitButton(Yii::t('auth', 'Auth for {des}', ['des'=>$model->description]), ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                            
            	            <?php ActiveForm::end(); ?>
            	        </div>
            	        <div class="col-lg-8 col-md-8">
                            <blockquote>注意事项：</blockquote>
                            <p>最小单位是权限，</p>
                            <p>父级单位是任务，</p>
                            <p>直接赋给用户的单位则是角色，</p>
                            <p>所有权限都属于任务，任务和权限直接可以赋给角色。</p>
                        </div>
            	    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
		</div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
