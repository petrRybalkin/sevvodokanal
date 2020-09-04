<?php

namespace common\models;

use Yii;

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
 * @property int|null $active
 * @property string|null $create_utime
 * @property string|null $update_utime
 */
class ArticleSearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_description', 'description'], 'string'],
            [['active'], 'integer'],
            [['create_utime', 'update_utime'], 'safe'],
            [['title', 'img', 'seoTitle', 'seoDescription'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'img' => 'Img',
            'seoTitle' => 'Seo Title',
            'seoDescription' => 'Seo Description',
            'active' => 'Active',
            'create_utime' => 'Create Utime',
            'update_utime' => 'Update Utime',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ArticleSearchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleSearchQuery(get_called_class());
    }
}
