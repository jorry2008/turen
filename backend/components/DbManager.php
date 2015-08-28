<?php

namespace backend\components;

use Yii;
use yii\rbac\Item;
use backend\components\Task;
use yii\db\Query;

/**
 * 
 * @author xia.q
 * @version 1.1
 *
 */
class DbManager extends \yii\rbac\DbManager
{
	//系统中所有的role对象
	private $roles = array();
	
	/**
	 * 获取所有任务
	 * @inheritdoc
	 */
	public function getTasks()
	{
	    return $this->getItems(Task::TYPE_TASK);
	}
	
	/**
	 * @inheritdoc
	 */
	public function getTask($name)
	{
	    $item = $this->getItem($name);
	    return $item instanceof Item && $item->type == Task::TYPE_TASK ? $item : null;
	}
	
	/**
	 * @inheritdoc
	 */
	public function removeAllTasks()
	{
	    $this->removeAllItems(Task::TYPE_TASK);
	}
	
	/**
	 * @inheritdoc
	 */
    public function getTasksByRole($roleName)
    {
        $childrenList = $this->getChildrenList();
        $result = [];
        $this->getChildrenRecursive($roleName, $childrenList, $result);
        if (empty($result)) {
            return [];
        }
        $query = (new Query)->from($this->itemTable)->where([
            'type' => Task::TYPE_TASK,
            'name' => array_keys($result),
        ]);
        $tasks = [];
        foreach ($query->all($this->db) as $row) {
            $tasks[$row['name']] = $this->populateItem($row);
        }
        return $tasks;
    }
	
	/**
	 * 按列的方式取出Task及下面的operation
	 * 
	 * @param int $col
	 * @return array
	 */
	public function getTasksAndPermissions()
	{
		$cols = array();
		$tasks = $this->getTasks();
		
		foreach ($tasks as $name => $authItem) {
		    $permissions = $this->getChildren($name);
			$cols[] = array(
					'task' => $authItem,
					'permissions' => $permissions,
            );
		}
		
		return $cols;
	}
	
	/**
	 * 批量删除指定task或者role的所有子item，通过
	 * 
	 * @param string $name
	 */
	public function removeItems($name)
	{
	    $items = $this->getChildren($name);
		foreach ($items as $value) {
			if($this->hasChild($this->getRole($name), $value)) {
				$this->removeChild($this->getRole($name), $value);
			}
		}
	}
	
	/**
	 * 删除task和operation及它们之间的关联
	 * //注意，一定要保留role
	 * 
	 * @return void
	 */
// 	public function clearTaskAndOperation()
// 	{
// 		//获取所有task
// 		$tasks = $this->getAuthItems(Item::TYPE_TASK);
// 		foreach ($tasks as $taskKey=>$task) {
// 			$operations = $this->getItemChildren($task->name);
// 			foreach ($operations as $opKey=>$operation) {
// 				//删除关联关系
// 				//$this->removeItemChild($task->name, $operation->name);//不需要特意去删除，因为有外键约束
// 				//删除operation
// 				$this->removeAuthItem($operation->name);
// 			}
// 			//删除task
// 			$this->removeAuthItem($task->name);
// 		}
// 	}

	/**
	 * 获取指定类型的操作item
	 *
	 * @param int $col
	 * @return array
	 */
// 	public function getAuthItemsForSelects($type = Item::TYPE_OPERATION)
// 	{
// 		if(!$this->roles) {
// 			$this->roles = $this->getAuthItems($type);
// 		}
// 		$temp = array();
// 		foreach ($this->roles as $name=>$authItem)
// 			$temp[$authItem->name] = $authItem->description;

// 		return $temp;
// 	}
}





