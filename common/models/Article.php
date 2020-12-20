<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\components\ImageUploadBehavior;
use DateTimeZone;
use DateTime;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $img
 * @property string|null $seoTitle
 * @property string|null $seoDescription
 * @property string|null $pdf
 * @property int|null $active
 * @property int|null $create_utime
 * @property int|null $update_utime
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            'thumb' => [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'img',
                'thumbs' => [
                    'thumb' => ['width' => 300, 'height' => 200],
                ],
                'filePath' => '@webroot/news/img/[[pk]].[[extension]]',
                'fileUrl' => '/news/img/[[pk]].[[extension]]',
                'thumbPath' => '@webroot/news/img/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/news/img/[[profile]]_[[pk]].[[extension]]',
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'pdf',
                'filePath' => '@webroot/news/pdf/[[pk]].[[extension]]',
                'fileUrl' => '/news/pdf/[[pk]].[[extension]]',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_utime', 'update_utime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_utime'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_description', 'description'], 'string'],
            [['active'], 'integer'],
            [['title', 'seoTitle', 'seoDescription'], 'string', 'max' => 255],
            [['create_utime', 'update_utime'], 'default', 'value' =>  new Expression('NOW()')],
            [['img'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['pdf'], 'file', 'extensions' => 'pdf']
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
            'img' => 'Фото',
            'pdf' => 'Pdf файл',
            'seoTitle' => 'Seo Title',
            'seoDescription' => 'Seo Description',
            'active' => 'Активная',
            'create_utime' => 'Создано',
            'update_utime' => 'Обновлено',
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

//    public function beforeSave($insert)
//    {
//        $currentTime = time();
//        $time = $this->timestampToDate($currentTime);
//        if ($this->isNewRecord) {
//            $this->create_utime = $time;
//            $this->update_utime = $time;
//
//        } else {
//            $this->update_utime = $time;
//        }
//
//        return parent::beforeSave($insert);
//    }
//
//    protected function timestampToDate($timestamp, $format = 'Y-m-d H:i:s')
//    {
//        $tz = new DateTimeZone("Europe/Kiev");
//
//        $date = DateTime::createFromFormat('U', $timestamp)->setTimezone($tz)->format($format);
//
//        return $date;
//    }

    /**
     * {@inheritdoc}
     * @return ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
