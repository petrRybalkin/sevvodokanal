<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $access_pages
 * @property int|null $access_news
 * @property int|null $access_users
 * @property int|null $access_abonents
 */
class Roles extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_pages', 'access_news', 'access_users', 'access_abonents'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'access_pages' => 'Редактирование страниц',
            'access_news' => 'Редактирование статей',
            'access_users' => 'Редактирование пользователей',
            'access_abonents' => 'Редактирование абонентов',
        ];
    }

    public static function statusList()
    {
        return [
            self::STATUS_INACTIVE => 'Нет',
            self::STATUS_ACTIVE => 'Да',
        ];
    }

    public static function statusColorList()
    {
        return [
            self::STATUS_INACTIVE => 'danger',
            self::STATUS_ACTIVE => 'success',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RolesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolesQuery(get_called_class());
    }
}
