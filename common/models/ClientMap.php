<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client_map".
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $score_id
 */
class ClientMap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'score_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'score_id' => 'Score ID',
        ];
    }

    public static function addClientMap($client_id, $score_id){

        $client_map = new ClientMap();
        $client_map->client_id = $client_id;
        $client_map->score_id = $score_id;
        $client_map->save();
    }

    public function getScore(){

    }
}
