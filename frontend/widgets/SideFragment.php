<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 通用碎片侧边栏挂件
 */

namespace frontend\widgets;

use common\models\extend\Fragment;

class SideFragment extends \yii\base\Widget
{
	public $short_code = '';
	
	//初始化
    public function init()
    {
        parent::init();
        
        if(empty($this->short_code))
			throw new InvalidConfigException('SideFragment config is error.');
    }
    
    //执行
    public function run()
    {
    	$model = Fragment::findOne(['short_code'=>$this->short_code]);
    	if($model) {
    		return $this->render('side-fragment', [
    			'title' => $model->title,
    			'model' => $model,
    		]);
    	}
    }
}
