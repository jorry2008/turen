<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 热门单页类型侧边栏挂件
 */

namespace frontend\widgets;

use common\models\cms\Column;

class SidePage extends \yii\base\Widget
{
	public $parent_short_code = '';
	public $title = '相关页面';
	
	//初始化
    public function init()
    {
        parent::init();
        
        if(empty($this->parent_short_code))
			throw new InvalidConfigException('SidePage config is error.');
    }
    
    //执行
    public function run()
    {
    	$model = Column::findOne(['short_code'=>$this->parent_short_code]);
    	$columns = $model->multiSelf;//取子列表，仅一层
    	if($columns) {
    		return $this->render('side-page', [
    			'title' => $this->title,
    			'models' => $columns,
    		]);
    	}
    }
}
