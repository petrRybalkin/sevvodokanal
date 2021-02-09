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
                'current_readings_watering', 'privilege_unpaid', 'correction', 'water_consumption', 'watering_consumption'], 'default'],
            [['account_number'], 'string', 'max' => 13],
            [['privilege'], 'string', 'max' => 2],
            [['medium_cubes'], 'string', 'max' => 1],
            [['synchronization'], 'integer'],
            [['accruals', 'total_tariff'], 'number', 'skipOnEmpty' => true]
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


    public static function debtBeginMonth($acc, $date)
    {
        /** @var IndicationsAndCharges $m */
        if (strtotime($date) == strtotime(date('Ym'))) {
            $m = IndicationsAndCharges::find()->where(['account_number' => $acc])
                ->andWhere(['month_year' => date('Ym')])
                ->one();
            if (!$m) {
                return 0;
            }
//            if ($m->synchronization > 0) {
//                \yii\helpers\VarDumper::dump(444444,10,1);exit;
//                return $m->debt_end_month;
//            }
            if ($m->current_readings_first > 0 || $m->current_readings_second > 0 || $m->current_readings_watering > 0) {
                $calcWaterCons = (($m->current_readings_first +
                            $m->current_readings_second +
                            $m->current_readings_watering -
                            $m->previous_readings_first -
                            $m->previous_readings_second -
                            $m->previous_readings_watering) * $m->score->tariff_for_water) +
                    (($m->current_readings_first +
                            $m->current_readings_second -
                            $m->previous_readings_first -
                            $m->previous_readings_second) * $m->score->tariff_for_stocks);
            } else {
                $calcWaterCons = 0;
            }


            $str = substr($m->month_year, 0, 4) . '-' . substr($m->month_year, 4, 6) . '-01';

            $lgotas = Payment::getLgotas($acc, $str, true);
            print_r($str);
            print_r($lgotas);

            $splacheno = ($lgotas[1] ? $lgotas[1]['sumAll'] : 0) +
                ($lgotas[0] ? $lgotas[0]['sumAll'] : 0);

            $lgo = $m->privilege_unpaid !== 0
                ? $m->privilege_unpaid
                : $lgotas[2]['sumAll'];

            $subs = $lgotas[3] ? $lgotas[3]['sumAll'] : 0;

            //hsumma (за предыдущий месяц)+
            //((th1+th2+tp-ph1-ph2-pp)*tarifv)+((th1+th2-ph1-ph2)*tarifst)
            //-оплата текущего месяца
            //-субсидия текущего месяца
            //-льгота текущего месяца
            //-коррекция текущего месяца.

            return ($m->debt_begin_month
                + $calcWaterCons
                - $splacheno
                - $subs
                - $lgo
                - $m->correction);
        }

        $m = IndicationsAndCharges::find()->where(['account_number' => $acc])
            ->andWhere(['month_year' => $date])
            ->one();
        return $m;


    }

    public static function clientDebt($acc, $date)
    {
        return IndicationsAndCharges::find()->where(['account_number' => $acc])
            ->andWhere(['month_year' => $date])
            ->one();
    }

    public static function isReadingsExists($account_number, $year, $field)
    {

        switch ($field) {
            case 'first':
                $field1 = 'previous_readings_first';
                $field2 = 'current_readings_first';
                break;
            case 'second':
                $field1 = 'previous_readings_second';
                $field2 = 'current_readings_second';
                break;
            case 'water':
                $field1 = 'previous_readings_watering';
                $field2 = 'current_readings_watering';
                break;

        }


        $query = IndicationsAndCharges::find()
            ->where(['account_number' => $account_number]);
        if ($year) {
            $query->andWhere(['between', 'month_year', $year . '01', $year . '12']);
        }
        $readings = $query->andWhere(
            ['or',
                ['not', [$field1 => 0]],
                ['not', [$field2 => 0]]
            ]
        )->all();

//        false = нет записей показаний
//        true = есть записи показаний
        return empty($readings) ? false : true;
    }

}
