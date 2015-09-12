<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_job}}".
 *
 * @property string $id
 * @property string $title
 * @property string $address
 * @property string $description
 * @property integer $num
 * @property integer $sex
 * @property string $treatment
 * @property string $usefullife
 * @property string $experience
 * @property string $education
 * @property string $lang
 * @property string $workdesc
 * @property string $content
 * @property string $post_time
 * @property string $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Job extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_job}}';
    }
    
    /**
     * 以行为的方式处理操作时间
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
    public function rules()
    {
        return [
            [['num', 'sex', 'post_time', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['workdesc', 'content'], 'string'],
            [['title', 'description', 'treatment', 'usefullife', 'experience', 'lang'], 'string', 'max' => 50],
            [['address', 'education'], 'string', 'max' => 80],
        	
        	[['title', 'content'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'title' => Yii::t('extend', 'Title'),
            'address' => Yii::t('extend', 'Address'),
            'description' => Yii::t('extend', 'Description'),
            'num' => Yii::t('extend', 'Num'),
            'sex' => Yii::t('extend', 'Sex'),
            'treatment' => Yii::t('extend', 'Treatment'),
            'usefullife' => Yii::t('extend', 'Usefullife'),
            'experience' => Yii::t('extend', 'Experience'),
            'education' => Yii::t('extend', 'Education'),
            'lang' => Yii::t('extend', 'Lang'),
            'workdesc' => Yii::t('extend', 'Workdesc'),
            'content' => Yii::t('extend', 'Content'),
            'post_time' => Yii::t('extend', 'Post Time'),
            'order' => Yii::t('common', 'Order'),
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return JobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobQuery(get_called_class());
    }
}
