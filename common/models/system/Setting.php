<?php

namespace common\models\system;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\base\InvalidParamException;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property string $id
 * @property string $code
 * @property string $key
 * @property string $value
 * @property integer $serialized
 */
class Setting extends \yii\db\ActiveRecord
{
    const SETTING_ACTIVE = 1;
    const SETTING_FORBID = 0;
    
    const CACHE_KEY = 'setting_model';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_array', 'is_visible'], 'integer'],
            [['code'], 'string', 'max' => 32],
            [['key'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system', 'ID'),
            'code' => Yii::t('system', 'Code'),
            'key' => Yii::t('system', 'Key'),
            'value' => Yii::t('system', 'Value'),
            'is_array' => Yii::t('system', 'Is Array'),
        ];
    }
    
    /**
     * 批量更新配置数据
     * @param array $post
     * @return boolean
     */
    public function batchSave(array $post)
    {
        foreach ($post as $key=>$value) {
            $model = (new Setting)->findOne(['key'=>$key]);
            if($model) {
                $model->setAttribute('value', $value);
                if($model->getOldAttribute('value') != $model->getAttribute('value')) {
                    $model->save(false);//不验证保存
                }
            } else {
                throw new InvalidParamException('Can\'t find the data,Please create the configuration items in the database!');
            }
        }
        
        return true;
    }
    
    /**
     * 更新配置缓存
     * @return boolean
     */
    public function updateCache()
    {
        $cache = Yii::$app->getCache();
        $models = Setting::find()->all();//整个缓存表，包括不可见内容
        
        //处理数组形式的数据
        foreach ($models as $key=>$model) {
            if($model->is_array) {
                $values = explode(',', $model->value);
                $newValues = [];
                if($values) {
                    foreach ($values as $value) {
                        $v = explode('=>', $value);
                        $newValues[$v[0]] = $v[1];
                    }
                }
                $models[$key]->value = $newValues;
            }
        }
        $data = Json::encode(ArrayHelper::map($models, 'key', 'value'));//获取数据
        
        if($cache->exists(self::CACHE_KEY)) {
            $cache->delete(self::CACHE_KEY);
        }
        
        $cache->set(self::CACHE_KEY, $data);
        return true;
    }
    
    /**
     * 获取配置缓存
     * @return string
     */
    public function getCache()
    {
        $cache = Yii::$app->getCache();
        if($cache->get(self::CACHE_KEY)) {
            return Json::decode($cache->get(self::CACHE_KEY));//返回数组
        } else {
            if($this->updateCache()) {//就地更新
                return Json::decode($cache->get(self::CACHE_KEY));//返回数组
            } else {
                //更新失败
            }
        }
    }
    
    /**
     * 删除配置缓存
     * @return boolean
     */
    public function deleteCache()
    {
        //
        return true;
    }
}







