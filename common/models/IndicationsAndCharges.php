<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indications_and_charges".
 *
 * @property int $id
 * @property string|null $account_number
 * @property int|null $month_year
 * @property string|null $privilege
 * @property int|null $count
 * @property float|null $debt_begin_month
 * @property int|null $previous_readings_first
 * @property int|null $current_readings_first
 * @property int|null $previous_readings_second
 * @property int|null $current_readings_second
 * @property int|null $previous_readings_watering
 * @property int|null $current_readings_watering
 * @property float|null $water_consumption
 * @property float|null $watering_consumption
 * @property float|null $total_tariff
 * @property float|null $accruals
 * @property float|null $privilege_unpaid
 * @property int|null $correction
 * @property float|null $debt_end_month
 * @property string|null $medium_cubes
 * @property int|null $synchronization
 */
class IndicationsAndCharges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indications_and_charges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['month_year', 'count', 'debt_begin_month', 'previous_readings_first', 'current_readings_first',
                'previous_readings_second', 'current_readings_second', 'previous_readings_watering',
                'current_readings_watering', 'privilege_unpaid', 'correction','water_consumption', 'watering_consumption'], 'default'],
            [['account_number'], 'string', 'max' => 13],
            [['privilege'], 'string', 'max' => 2],
            [['medium_cubes'], 'string', 'max' => 1],
            [['synchronization'], 'integer'],
            [['accruals','total_tariff'], 'number', 'skipOnEmpty' => true]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_number' => 'Account Number',
            'month_year' => 'Month Year',
            'privilege' => 'Privilege',
            'count' => 'Count',
            'debt_begin_month' => 'Debt Begin Month',
            'previous_readings_first' => 'Previous Readings First',
            'current_readings_first' => 'Current Readings First',
            'previous_readings_second' => 'Previous Readings Second',
            'current_readings_second' => 'Current Readings Second',
            'previous_readings_watering' => 'Previous Readings Watering',
            'current_readings_watering' => 'Current Readings Watering',
            'water_consumption' => 'Water Consumption',
            'watering_consumption' => 'Watering Consumption',
            'total_tariff' => 'Total Tariff',
            'accruals' => 'Accruals',
            'privilege_unpaid' => 'Privilege Unpaid',
            'correction' => 'Correction',
            'debt_end_month' => 'Debt End Month',
            'medium_cubes' => 'Medium Cubes',
        ];
    }

    public function getScore()
    {
        return $this->hasOne(ScoreMetering::class, ['account_number' => 'account_number']);
    }

    public function getWater()
    {
        return $this->hasOne(WaterMetering::class, ['account_number' => 'account_number']);
    }


    public static function debtBeginMonth($acc, $date){
//        выбрать предыдущ мес
      return  IndicationsAndCharges::find()->where(['account_number' => $acc])
            ->andWhere(['between', 'month_year', $date, date("d.m.Y", strtotime('first day of this month'))])
        ->one();

    }
}
