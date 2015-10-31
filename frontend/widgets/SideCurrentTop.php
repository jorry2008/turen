<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 当前关联同辈类型侧边栏内容排行挂件
 */

namespace frontend\widgets;

class SideCurrentTop extends \yii\base\Widget
{
	public $title = '';
	
	//初始化
    public function init()
    {
        parent::init();
        
        
    }
    
    //执行
    public function run()
    {
    	
    	
    	
    	return $this->render('side-current-top', [
    		'title'=>$this->title
    	]);
    }
}
