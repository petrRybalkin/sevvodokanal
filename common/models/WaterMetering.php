<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "water_metering".
 *
 * @property int $id
 * @property string|null $lic_schet
 * @property int|null $regn
 * @property string|null $nh1
 * @property string|null $nh2
 * @property string|null $np
 * @property int|null $ph1
 * @property int|null $ph2
 * @property int|null $pp
 * @property string|null $dppp
 * @property string|null $namh1
 * @property string|null $namh2
 * @property string|null $namp
 * @property string|null $datgos
 * @property string|null $srkub
 * @property int|null $khvsrn
 */
class WaterMetering extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'water_metering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regn', 'ph1', 'ph2', 'pp', 'khvsrn'], 'integer'],
            [['dppp', 'datgos'], 'safe'],
            [['lic_schet', 'nh1', 'nh2', 'np', 'namh1', 'namh2', 'namp', 'srkub'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lic_schet' => 'Lic Schet',
            'regn' => 'Regn',
            'nh1' => 'Nh1',
            'nh2' => 'Nh2',
            'np' => 'Np',
            'ph1' => 'Ph1',
            'ph2' => 'Ph2',
            'pp' => 'Pp',
            'dppp' => 'Dppp',
            'namh1' => 'Namh1',
            'namh2' => 'Namh2',
            'namp' => 'Namp',
            'datgos' => 'Datgos',
            'srkub' => 'Srkub',
            'khvsrn' => 'Khvsrn',
        ];
    }

    public static function getWaterMeteringInAccNum($account_number){

        return WaterMetering::find()->where(['account_number' => $account_number])->all();
    }
}
