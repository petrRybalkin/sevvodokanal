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
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['score_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScoreMetering::className(), 'targetAttribute' => ['score_id' => 'id']],
            [['score_id'], 'unique', 'message' => 'Цей рахунок вже використовується іншим абонентом.'],
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

    public static function addClientMap($client_id, $score_id)
    {
        if (!self::find()->where(['client_id' => $client_id, 'score_id' => $score_id])->one()){
            $client_map = new ClientMap();
            $client_map->client_id = $client_id;
            $client_map->score_id = $score_id;
            if(!$client_map->save()){
                return $client_map->getErrors('score_id');
            }
            return true;
        }
    }

    public function getScore()
    {
        return $this->hasOne(ScoreMetering::class, ['id' => 'score_id']);
    }
}
