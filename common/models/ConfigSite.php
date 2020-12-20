<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "config_site".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $title
 * @property string|null $value
 * @property string|null $address
 * @property string|null $name_header
 * @property string|null $name_footer
 * @property string|null $phone_priem
 * @property string|null $phone_disp
 * @property int|null $action
 */
class ConfigSite extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
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
            [['name', 'title', 'value', 'name_header', 'name_footer', 'address', 'phone_priem', 'phone_disp'], 'string'],
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
            'action' => 'Передача показаний',
            'name_header' => 'Название в шапке сайта',
            'name_footer' => 'Название в подвале сайта',
            'address' => 'Адресс',
            'phone_priem' => 'Телефон приемной',
            'phone_disp' => 'Телефон диспетчера',
        ];
    }

    public static function statusList()
    {
        return [
            self::STATUS_INACTIVE => 'Отключено',
            self::STATUS_ACTIVE => 'Включено',
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
     * @param null $action
     * @return string
     */
    public function getStatusLabel($default = '-', $action = null)
    {
        return ArrayHelper::getValue(self::statusList(), $action ?: $this->action, $default);
    }

    /**
     * @param string $default
     * @param null $action
     * @return string
     */
    public function getStatusColor($default = 'default', $action = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $action ?: $this->action, $default);
    }

    /**
     * @param array $options
     * @return string
     */
    public function getStatusTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusColor();
        }
        return Html::tag('span', $this->getStatusLabel(), $options);
    }

    public static function getSettings($id)
    {

        return ConfigSite::find()->where(['id' => $id])->orderBy(['id'=>SORT_DESC])->one();
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
