<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config_site".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property string|null $value
 * @property int|null $action
 */
class ConfigSite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config_site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'value'], 'string'],
            [['action'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'value' => 'Value',
            'action' => 'Action',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConfigSiteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConfigSiteQuery(get_called_class());
    }
}
