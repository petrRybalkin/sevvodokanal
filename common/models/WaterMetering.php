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
            [['act_number', 'previous_readings_first', 'previous_readings_second', 'previous_watering_readings', 'number_medium_cubes'], 'integer'],
            [['date_previous_readings', 'verification_date'], 'safe'],
            [['account_number', 'type_first', 'type_second', 'type_watering', 'water_metering_first', 'water_metering_second', 'watering_number', 'medium_cubes'], 'string'],
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

    public static function getWaterMeteringInAccNum($account_number)
    {

        return WaterMetering::find()->where(['account_number' => $account_number])->orderBy(['id'=>SORT_DESC])->one();
    }
}
