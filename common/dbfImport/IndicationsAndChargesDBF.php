<?php

namespace common\dbfImport;


use Yii;

class IndicationsAndChargesDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'lic_schet' => [
                'field' => 'account_number',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер особового рахунку',
            ],
            'mes' => [
                'field' => 'month_year',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Місяць та Рік',
            ],
            'lgo' => [
                'field' => 'privilege',
                'type' => static::TYPE_STRING,
                'title' => 'Наявність пільги',
            ],
            'kol' => [
                'field' => 'count',
                'type' => static::TYPE_STRING,
                'title' => 'Кількість зареєстрованих осіб',
            ],
            'hsal' => [
                'field' => 'debt_begin_month',
                'type' => static::TYPE_STRING,
                'title' => 'Заборгованість на початок місяця',
            ],
            'ph1' => [
                'field' => 'previous_readings_first',
                'type' => static::TYPE_STRING,
                'title' => 'Попередні показання засобу обліку № 1',
            ],
            'th1' => [
                'field' => 'current_readings_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Поточні показання засобу обліку № 1',
            ],
            'ph2' => [
                'field' => 'previous_readings_second',
                'type' => static::TYPE_FLOAT,
                'title' => 'Попередні показання засобу обліку № 2',
            ],
            'th2' => [
                'field' => 'current_readings_second',
                'type' => static::TYPE_FLOAT,
                'title' => 'Поточні показання засобу обліку № 2',
            ],
            'pp' => [
                'field' => 'previous_readings_watering',
                'type' => static::TYPE_FLOAT,
                'title' => 'Попередні показання засобу обліку для поливу',
            ],
            'tp' => [
                'field' => 'current_readings_watering',
                'type' => static::TYPE_FLOAT,
                'title' => 'Поточні показання засобу обліку для поливу',
            ],
            'khv' => [
                'field' => 'water_consumption',
                'type' => static::TYPE_FLOAT,
                'title' => 'Обсяг водоспоживання по воді',
            ],
            'kpv' => [
                'field' => 'watering_consumption',
                'type' => static::TYPE_FLOAT,
                'title' => 'Обсяг водоспоживання по поливу',
            ],
            'sumtarif' => [
                'field' => 'total_tariff',
                'type' => static::TYPE_FLOAT,
                'title' => 'Сумарний тариф',
            ],
            'nac' => [
                'field' => 'accruals',
                'type' => static::TYPE_FLOAT,
                'title' => 'Нарахування',
            ],
            'lgota' => [
                'field' => 'privilege_unpaid',
                'type' => static::TYPE_FLOAT,
                'title' => 'Пільга не монетизована',
            ],
            'korek' => [
                'field' => 'correction',
                'type' => static::TYPE_FLOAT,
                'title' => 'Корекція',
            ],
            'hsumma' => [
                'field' => 'debt_end_month',
                'type' => static::TYPE_FLOAT,
                'title' => 'Заборгованість на кінець місяця',
            ],
            'srkub' => [
                'field' => 'medium_cubes',
                'type' => static::TYPE_FLOAT,
                'title' => 'Ознака середніх кубов',
            ] ,
            'synchronization' => [
                'field' => 'synchronization',
                'type' => static::TYPE_NUMERIC,
            ]
        ];
    }

    public function tableFaild()
    {
        return [
            'account_number',
            'month_year',
            'privilege',
            'count',
            'debt_begin_month',
            'previous_readings_first',
            'current_readings_first',
            'previous_readings_second',
            'current_readings_second',
            'previous_readings_watering',
            'current_readings_watering',
            'water_consumption',
            'watering_consumption',
            'total_tariff',
            'accruals',
            'privilege_unpaid',
            'correction',
            'debt_end_month',
            'medium_cubes',
            'synchronization'
        ];
    }

    public function save()
    {
      Yii::$app->db->createCommand()->batchInsert('indications_and_charges',[
            'account_number',
            'month_year',
            'privilege',
            'count',
            'debt_begin_month',
            'previous_readings_first',
            'current_readings_first',
            'previous_readings_second',
            'current_readings_second',
            'previous_readings_watering',
            'current_readings_watering',
            'water_consumption',
            'watering_consumption',
            'total_tariff',
            'accruals',
            'privilege_unpaid',
            'correction',
            'debt_end_month',
            'medium_cubes',
            'synchronization'
        ], $this->parser(10))->execute();
    }


}
