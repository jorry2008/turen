<?php

namespace common\models\catalog;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use common\components\helpers\General;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $keyword
 * @property string $brief
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $top
 * @property string $column
 * @property string $sort
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    const CATEGORY_STATUS_ON = 1;
    const CATEGORY_STATUS_OFF = 0;
    
    const CATEGORY_IS_TOP = 1;
    const CATEGORY_NOT_TOP = 0;
    
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
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'parent_id', 'name', 'status'], 'required'],
            [['parent_id', 'top', 'column', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['keyword', 'brief', 'image'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'parent_id' => Yii::t('catalog', 'Parent Id'),
            'keyword' => Yii::t('catalog', 'Keyword'),
            'brief' => Yii::t('catalog', 'Brief'),
            'name' => Yii::t('catalog', 'Name'),
            'description' => Yii::t('catalog', 'Description'),
            'image' => Yii::t('catalog', 'Image'),
            'top' => Yii::t('catalog', 'Top'),
            'column' => Yii::t('catalog', 'Column'),
            'sort' => Yii::t('catalog', 'Sort'),
            'status' => Yii::t('catalog', 'Status'),
            'created_at' => Yii::t('catalog', 'Created At'),
            'updated_at' => Yii::t('catalog', 'Updated At'),
        ];
    }
    
    /**
     * 自我表关联
     */
    public function getMySelf()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }
    
    /**
     * 保存之前处理文件上传
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
        /*
        if(parent::beforeSave($insert)) {
            $files = UploadedFile::getInstances($this, 'image');
            $result = General::uploadToWebFilePath($files, 'category');//批量上传文件，并返回路径字符串
            if(is_array($result)) {
                $this->addError('image', $result['error']);
                return false;
            } else {
                $this->image = $result;
            }
            return true;
        } else {
            return false;
        }
        */
        if(parent::beforeSave($insert)) {
            if($insert) {
    
            } else {
    
            }
    
            //整理上传的图上路径
            $images = explode(',', $this->image);
            if(!empty($images)) {
                foreach ($images as $key=>$image) {
                    if(empty($image)) {
                        unset($images[$key]);
                    } else {
                        $images[$key] = trim($images[$key]);
                    }
                }
                $this->image = implode(',', $images);
            }
    
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
