<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'action', 'phone'], 'integer'],
            [['username', 'email'], 'string'],
            [['created_at', 'message', 'auth_key'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'username' => $this->username,
//            'email' => $this->email,
//            'phone' => $this->phone,
            'created_at' => $this->created_at,
        ]);
        if ($this->auth_key) {
            $query->joinWith('clientMap');
            $query->leftJoin('score_metering', 'score_metering.id = client_map.score_id');
            $query->andFilterWhere(['like', 'score_metering.account_number', $this->auth_key]);
        }
        $query->andFilterWhere(['like', 'email', trim($this->email)])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);


        return $dataProvider;
    }


}
