<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
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

    public function frontendSearch($params, $condition = null)
    {
        if (isset($condition)) {
            $query = Article::find()
                ->orderBy('create_utime DESC')
                ->where($condition);
        } else {
            $query = Article::find()
                ->orderBy('create_utime DESC');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $dataProvider->sort->attributes['title'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'                    => $this->id,
            'title'                 => $this->title,
            'active'                => $this->active,
            'short_description'     => $this->short_description,
            'create_utime'          => $this->create_utime,
            'update_utime'          => $this->update_utime,
            'description'           => $this->description,
            'img'                   => $this->img,
            'seoTitle'              => $this->seoTitle,
            'seoDescription'        => $this->seoDescription,

        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
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
