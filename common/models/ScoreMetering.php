<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "score_metering".
 *
 * @property int $id
 * @property string|null $account_number
 * @property int|null $act_number
 * @property string|null $name_of_the_tenant
 * @property string|null $address
 * @property string|null $norm
 * @property string|null $type_of_housing
 * @property int|null $registered_persons
 * @property float|null $tariff_for_water
 * @property float|null $tariff_for_stocks
 * @property float|null $total_tariff
 */
class ScoreMetering extends \yii\db\ActiveRecord
{
    public $sum;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'score_metering';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registered_persons'], 'integer'],
            [['act_number'], 'safe'],
            [['tariff_for_water', 'tariff_for_stocks', 'total_tariff'], 'number'],
            [['account_number'], 'string', 'max' => 13],
            [['name_of_the_tenant', 'address', 'norm', 'type_of_housing', 'sum'], 'string', 'max' => 255],
            [['account_number'], 'required'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_number' => 'Особовий рахунок',
            'act_number' => 'Pеєстраційний номер акту',
            'name_of_the_tenant' => 'Name Of The Tenant',
            'address' => 'Address',
            'norm' => 'Norm',
            'type_of_housing' => 'Type Of Housing',
            'registered_persons' => 'Registered Persons',
            'tariff_for_water' => 'Tariff For Water',
            'tariff_for_stocks' => 'Tariff For Stocks',
            'total_tariff' => 'Total Tariff',
        ];
    }

    public function getVodomers()
    {
        return $this->hasMany(WaterMetering::class, ['account_number' => 'account_number']);
    }
    public function getIndications()
    {
        return $this->hasMany(IndicationsAndCharges::class, ['account_number' => 'account_number']);
    }
}
