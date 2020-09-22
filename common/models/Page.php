<?php

namespace common\models;

use common\models\Category;
use Yii;
use yii\helpers\Html;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $img
 * @property string|null $seoTitle
 * @property string|null $seoDescription
 * @property int $active
 * @property int|null $sidebar
 * @property int|null $main_menu
 * @property int|null $footer
 * @property int|null $parent_page
 * @property int|null $create_utime
 * @property int|null $update_utime
 */
class Page extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_MENU_INACTIVE = 0;
    const STATUS_MENU_ACTIVE = 1;
    const STATUS_SIDEBAR_INACTIVE = 0;
    const STATUS_SIDEBAR_ACTIVE = 1;
    const STATUS_FOOTER_INACTIVE = 0;
    const STATUS_FOOTER_ACTIVE = 1;
    const STATUS_FOOTER_ACTIVE2 = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_description', 'description'], 'string'],
            [['active', 'sidebar', 'main_menu', 'footer'], 'integer'],
            [['parent_page'], 'integer'],
            [['title', 'img', 'seoTitle', 'seoDescription'], 'string', 'max' => 255],
            [['create_utime', 'update_utime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'short_description' => 'Короткое описание',
            'description' => 'Полный текст',
            'img' => 'Img',
            'seoTitle' => 'Seo Title',
            'active' => 'Активная',
            'main_menu' => 'Показывать в главном меню',
            'sidebar' => 'Показывать в сайдбаре',
            'footer' => 'Показать в футере',
            'parent_page' => 'Родительская',
            'seoDescription' => 'Seo Description',
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

    public static function statusMenuList()
    {
        return [
            self::STATUS_MENU_INACTIVE => 'Нет',
            self::STATUS_MENU_ACTIVE => 'Да',
        ];
    }

    public static function statusMenuColorList()
    {
        return [
            self::STATUS_MENU_INACTIVE => 'danger',
            self::STATUS_MENU_ACTIVE => 'success',
        ];
    }

    public static function statusSidebarList()
    {
        return [
            self::STATUS_SIDEBAR_INACTIVE => 'Нет',
            self::STATUS_SIDEBAR_ACTIVE => 'Да',
        ];
    }

    public static function statusSidebarColorList()
    {
        return [
            self::STATUS_SIDEBAR_INACTIVE => 'danger',
            self::STATUS_SIDEBAR_ACTIVE => 'success',
        ];
    }

    public static function statusFooterList()
    {
        return [
            self::STATUS_FOOTER_ACTIVE => 'Да',
            self::STATUS_FOOTER_ACTIVE2 => 'Да',
            self::STATUS_FOOTER_INACTIVE => 'Hет',
        ];
    }

    public static function statusFooterColorList()
    {
        return [
            self::STATUS_FOOTER_INACTIVE => 'danger',
            self::STATUS_FOOTER_ACTIVE => 'success',
            self::STATUS_FOOTER_ACTIVE2 => 'success',
        ];
    }

    /**
     * @param string $default
     * @param null $active
     * @return string
     */
    public function getStatusLabel($default = '-', $active = null)
    {
        return ArrayHelper::getValue(self::statusList(), $active ?: $this->active, $default);
    }

    /**
     * @param string $default
     * @param null $active
     * @return string
     */
    public function getStatusColor($default = 'default', $active = null)
    {
        return ArrayHelper::getValue(self::statusColorList(), $active ?: $this->active, $default);
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

    /**
     * @param string $default
     * @param null $main_menu
     * @return string
     * @throws \Exception
     */
    public function getStatusMenuLabel($default = '-', $main_menu = null)
    {
        return ArrayHelper::getValue(self::statusMenuList(), $main_menu ?: $this->main_menu, $default);
    }

    /**
     * @param string $default
     * @param null $main_menu
     * @return string
     * @throws \Exception
     */
    public function getStatusMenuColor($default = 'default', $main_menu = null)
    {
        return ArrayHelper::getValue(self::statusMenuColorList(), $main_menu ?: $this->main_menu, $default);
    }

    /**
     * @param array $options
     * @return string
     * @throws \Exception
     */
    public function getStatusMenuTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusMenuColor();
        }
        return Html::tag('span', $this->getStatusMenuLabel(), $options);
    }

    /**
     * @param string $default
     * @param null $sidebar
     * @return string
     * @throws \Exception
     */
    public function getStatusSidebarLabel($default = '-', $sidebar = null)
    {
        return ArrayHelper::getValue(self::statusSidebarList(), $sidebar ?: $this->sidebar, $default);
    }

    /**
     * @param string $default
     * @param null $sidebar
     * @return string
     * @throws \Exception
     */
    public function getStatusSidebarColor($default = 'default', $sidebar = null)
    {
        return ArrayHelper::getValue(self::statusSidebarColorList(), $sidebar ?: $this->sidebar, $default);
    }

    /**
     * @param array $options
     * @return string
     * @throws \Exception
     */
    public function getStatusSidebarTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusSidebarColor();
        }
        return Html::tag('span', $this->getStatusSidebarLabel(), $options);
    }

    /**
     * @param string $default
     * @param null $footer
     * @return string
     * @throws \Exception
     */
    public function getStatusFooterLabel($default = '-', $footer = null)
    {
        return ArrayHelper::getValue(self::statusFooterList(), $footer ?: $this->footer, $default);
    }

    /**
     * @param string $default
     * @param null $footer
     * @return string
     * @throws \Exception
     */
    public function getStatusFooterColor($default = 'default', $footer = null)
    {
        return ArrayHelper::getValue(self::statusFooterColorList(), $footer ?: $this->footer, $default);
    }

    /**
     * @param array $options
     * @return string
     * @throws \Exception
     */
    public function getStatusFooterTag($options = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'label label-' . $this->getStatusFooterColor();
        }
        return Html::tag('span', $this->getStatusFooterLabel(), $options);
    }
    
    public static function getParents()
    {
        return self::find()->where([
            'parent_page' => 0,
        ]);
//        ->orderBy([
//            'sort' => SORT_DESC,
//        ]);
    }

    public static function getParentsList()
    {
        return ArrayHelper::map(self::getParents()->select('id, title')->asArray()->all(), 'id', 'title');
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_page']);
    }

    public function beforeSave($insert)
    {
        $time = date('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->create_utime = $time;
        }

        $this->update_utime = $time;
        return parent::beforeSave($insert);
    }

    /**
     * @return ActiveQuery
     */
    public static function getChild()
    {
        $model = Category::find();
        return self::find()
            ->where(['parent_page' => $model->id])
            ->where(['active' => 1, 'main_menu' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getMenus()
    {
        return self::find()
            ->where(['active' => 1, 'main_menu' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getInfo()
    {
        return self::find()->where(['parent_page' => 1, 'active' => 1, 'main_menu' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getAbout()
    {
        return self::find()->where(['parent_page' => 2, 'active' => 1, 'main_menu' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getFooterLeft()
    {
        return self::find()->where(['active' => 1, 'footer' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getFooterRight()
    {
        return self::find()->where(['active' => 1, 'footer' => 2]);
    }

    /**
     * @return ActiveQuery
     */
    public static function getSidebars()
    {
        return self::find()
            ->where(['active' => 1, 'sidebar' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
