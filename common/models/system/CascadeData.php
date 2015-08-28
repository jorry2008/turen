<?php

namespace common\models\system;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cascade_data}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $level
 * @property integer $data_group
 * @property string $updated_at
 */
class CascadeData extends \yii\db\ActiveRecord
{
    const LEVEL_COUNTRY = 0;
    const LEVEL_PROVINCE = 1;//LEVEL_DISTRICT自治区和省是一样的
    const LEVEL_CITY = 2;
    const LEVEL_POWIAT = 3;
    
    const DATA_TYPE_COUNTRY = 0;
    const DATA_TYPE_CERTIFY = 1;
    
    public $levelArr = [];
    public $dataGroupArr = [];
    
    public function init()
    {
        parent::init();
        
        $this->levelArr = [
            self::LEVEL_COUNTRY => Yii::t('system', 'Country'),
            self::LEVEL_PROVINCE => Yii::t('system', 'Province'),
            self::LEVEL_CITY => Yii::t('system', 'City'),
            self::LEVEL_POWIAT => Yii::t('system', 'Powiat'),
        ];
        
        $this->dataGroupArr = [
            self::DATA_TYPE_COUNTRY => Yii::t('system', 'Area Data'),
            self::DATA_TYPE_CERTIFY => Yii::t('system', 'Certify Data'),
        ];
        
    }
    
    /**
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            'timemap' => [
                'class'=>TimestampBehavior::className(),
                'updatedAtAttribute'=>'updated_at',
                'createdAtAttribute'=>false,
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cascade_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'level', 'data_group'], 'required'],
            [['id', 'parent_id', 'level', 'data_group', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'parent_id' => Yii::t('system', 'Parent Id'),
            'name' => Yii::t('system', 'Name'),
            'level' => Yii::t('system', 'Level'),
            'data_group' => Yii::t('system', 'Data Group'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            //处理主键自增问题
            if($insert) {
                $maxModel = CascadeData::find()->select('id')->orderBy(['id' => SORT_DESC])->one();
                if(!$maxModel) {
                    $this->id = 1;
                } else {
                    $this->id = $maxModel->id + 1;
                }
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 查询数据
     */
    public function findDate($level, $parent_id)
    {
        return parent::findAll(['level'=>$level, 'parent_id'=>$parent_id]);
    }
    
    /**
     * 自我表关联
     */
    public function getMySelf()
    {
        return $this->hasOne(CascadeData::className(), ['id' => 'parent_id']);
    }
    
    /**
     * @inheritdoc
     * @return CascadeDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CascadeDataQuery(get_called_class());
    }
}
