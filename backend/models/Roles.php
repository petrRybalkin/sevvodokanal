<?php

namespace backend\models;

use common\models\Page;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $access_pages
 * @property int|null $access_news
 * @property int|null $access_users
 * @property int|null $access_abonents
 * @property int|null $access_one_page
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
            //['access_one_page', Page::getPages()],
            ['access_one_page', 'integer'],
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
            'access_one_page' => '',
        ];
    }

    public static function enumCategory($id = null)
    {
        static $enum;
        if (!isset($enum)) {
            $enum = self::find()
                ->orderBy('name')
                ->all();
            $enum = ArrayHelper::map($enum, 'id', 'name');
        }
        return $id === null ? $enum : ArrayHelper::getValue($enum, $id, '');
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
     * @param string $default
     * @param null $access_pages
     * @return string
     */
    public function getStatusPagesLabel($default = '-', $access_pages = null)
    {
        return ArrayHelper::getValue(self::statusList(), $access_pages ?: $this->access_pages, $default);
    }

    /**
     * @param string $default
     * @param null $access_pages
     * @return string
     */
    public function getStatusPagesColor($default = 'default', $access_pages = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $access_pages ?: $this->access_pages, $default);
    }

    /**
     * @param array $options
     * @return string
     */
    public function getStatusPagesTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusPagesColor();
        }
        return Html::tag('span', $this->getStatusPagesLabel(), $options);
    }

    /**
     * @param string $default
     * @param null $access_news
     * @return string
     */
    public function getStatusNewsLabel($default = '-', $access_news = null)
    {
        return ArrayHelper::getValue(self::statusList(), $access_news ?: $this->access_news, $default);
    }

    /**
     * @param string $default
     * @param null $access_news
     * @return string
     */
    public function getStatusNewsColor($default = 'default', $access_news = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $access_news ?: $this->access_news, $default);
    }

    /**
     * @param array $options
     * @return string
     */
    public function getStatusNewsTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusNewsColor();
        }
        return Html::tag('span', $this->getStatusNewsLabel(), $options);
    }

    /**
     * @param string $default
     * @param null $access_users
     * @return string
     */
    public function getStatusUsersLabel($default = '-', $access_users = null)
    {
        return ArrayHelper::getValue(self::statusList(), $access_users ?: $this->access_users, $default);
    }

    /**
     * @param string $default
     * @param null $access_users
     * @return string
     */
    public function getStatusUsersColor($default = 'default', $access_users = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $access_users ?: $this->access_users, $default);
    }

    /**
     * @param array $options
     * @return string
     */
    public function getStatusUsersTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusUsersColor();
        }
        return Html::tag('span', $this->getStatusUsersLabel(), $options);
    }

    /**
     * @param string $default
     * @param null $access_abonents
     * @return string
     */
    public function getStatusAbonentLabel($default = '-', $access_abonents = null)
    {
        return ArrayHelper::getValue(self::statusList(), $access_abonents ?: $this->access_abonents, $default);
    }

    /**
     * @param string $default
     * @param null $access_abonents
     * @return string
     */
    public function getStatusAbonentColor($default = 'default', $access_abonents = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $access_abonents ?: $this->access_abonents, $default);
    }

    /**
     * @param array $options
     * @return string
     */
    public function getStatusAbonentTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusAbonentColor();
        }
        return Html::tag('span', $this->getStatusAbonentLabel(), $options);
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
