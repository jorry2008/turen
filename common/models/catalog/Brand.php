<?php

namespace common\models\catalog;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $desc
 * @property string $url
 * @property integer $sort
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Brand extends \yii\db\ActiveRecord
{
    const BRAND_STATUS_ON = 1;
    const BRAND_STATUS_OFF = 0;
    
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
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc','name'], 'required'],
            [['desc'], 'string'],
            [['image'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 120],
            [['sort', 'status', 'created_at', 'updated_at'], 'integer'],
            
            //不使用原生的上传方式
            //[['image'], 'file', 'maxSize' => 2097152, 'extensions'=>explode(',', Yii::$app->params['config']['config_pic_extension'])],
            [['url'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'name' => Yii::t('catalog', 'Name'),
            'image' => Yii::t('catalog', 'Image'),
            'desc' => Yii::t('catalog', 'Desc'),
            'url' => Yii::t('catalog', 'Url'),
            'sort' => Yii::t('catalog', 'Sort'),
            'status' => Yii::t('catalog', 'Status'),
            'created_at' => Yii::t('catalog', 'Created At'),
            'updated_at' => Yii::t('catalog', 'Updated At'),
        ];
    }
    
    /**
     * 保存之前处理文件上传
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            /*
            $files = UploadedFile::getInstances($this, 'image');
            $result = General::uploadToWebFilePath($files, 'brand');//批量上传文件，并返回路径字符串
            if(is_array($result)) {
                $this->addError('image', $result['error']);
                return false;
            } else {
                $this->image = $result;
            }
            */
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
     * @return BrandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BrandQuery(get_called_class());
    }
}
