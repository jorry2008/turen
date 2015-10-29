<?php

namespace common\models\system;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%system_explorer}}".
 *
 * @property string $id
 * @property integer $is_exsit
 * @property integer $status
 * @property string $action
 * @property string $session
 * @property string $field
 * @property string $path
 * @property string $dir
 * @property integer $created_at
 * @property integer $updated_at
 */
class Explorer extends \yii\db\ActiveRecord
{
	const EXIST_YES = 1;
	const EXIST_NO = 0;
	
	const STATUS_COMPLETE = 0;//操作完成
	const STATUS_DRAFT = 1;//操作中
	const STATUS_LOSE = 2;//丢失

	const ACTION_INS = 'ins';//插入
	const ACTION_DEL = 'del';//删除
	
	/**
	 * 行为处理时间
	 * @see \yii\base\Component::behaviors()
	 */
	public function behaviors()
	{
		return [
			'timemap' => [
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at'
			]
		];
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_explorer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_exsit', 'status', 'created_at', 'updated_at'], 'integer'],
            [['action', 'dir'], 'string', 'max' => 10],
            [['session', 'field', 'path'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system', 'ID'),
            'is_exsit' => Yii::t('system', 'Is Exsit'),
            'status' => Yii::t('system', 'Status'),
            'action' => Yii::t('system', 'Action'),
            'session' => Yii::t('system', 'Sesstion'),
            'field' => Yii::t('system', 'Field'),
            'path' => Yii::t('system', 'Path'),
            'dir' => Yii::t('system', 'Dir'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return ExplorerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExplorerQuery(get_called_class());
    }
}
