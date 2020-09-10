<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    public static function enumCategory($id = null)
    {
        static $enum;
        if (!isset($enum)) {
            $enum = self::find()
                ->orderBy('title')
                ->all();
            $enum = ArrayHelper::map($enum, 'id', 'title');
        }
        return $id === null ? $enum : ArrayHelper::getValue($enum, $id, '');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new CategoryQuery(get_called_class());
//    }
}
