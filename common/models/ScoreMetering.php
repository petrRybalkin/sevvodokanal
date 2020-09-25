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
            [['act_number', 'registered_persons'], 'integer'],
            [['tariff_for_water', 'tariff_for_stocks', 'total_tariff'], 'number'],
            [['account_number'], 'string', 'max' => 13],
            [['name_of_the_tenant', 'address', 'norm', 'type_of_housing', 'sum'], 'string', 'max' => 255],
            [['account_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['account_number' => 'account_number'], 'message' => 'Немає такого особового рахунку 
                - швидше за все, Ви вводите некоректно номер особового рахунку.'],
            [['act_number'], 'exist', 'targetClass' => ScoreMetering::class,
                'targetAttribute' => ['act_number' => 'act_number'], 'message' => '"Немає такого номера акта» - швидше за все, Ви вводите некоректно номер акта.'],
            [['account_number'], 'required'],
            [['act_number'], 'required', 'when' => function ($model) {
                return $model->sum == '';
            }, 'whenClient' => "function (attribute, value) {
        return $('#scoremetering-sum').val() == '';
    }"],
            [['sum'], 'required', 'when' => function ($model) {
                return $model->act_number == '';
            }, 'whenClient' => "function (attribute, value) {
        return $('#scoremetering-act_number').val() == '';
    }"],


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
}
