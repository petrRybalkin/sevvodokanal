<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClientMap;

/**
 * ClientMapSearch represents the model behind the search form of `common\models\ClientMap`.
 */
class ClientMapSearch extends ClientMap
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'score_id'], 'integer'],
            [['client_id'], 'string'],
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
        $query = ClientMap::find()
            ->groupBy('client_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'client_id' => $this->client_id,
//            'score_id' => $this->score_id,
        ]);

        if ($this->client_id) {
            $query->leftJoin('user', 'user.id = client_map.client_id');
            $query->andFilterWhere(['like', 'user' . '.email', $this->client_id]);
//            \yii\helpers\VarDumper::dump($query->createCommand()->rawSql,10,1);exit;
        }

        if ($this->score_id) {
            $query->joinWith('score');
            $query->andFilterWhere(['like', 'score_metering' . '.account_number', $this->score_id]);

        }

        return $dataProvider;
    }
}
