<?php

namespace common\dbfImport;

use common\models\WaterMetering;
use Yii;

class InfoDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'lic_schet' => [
                'field' => 'account_number',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер особового рахунку',
            ],
            'regn' => [
                'field' => 'act_number',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Реєстраційний номер акту',
            ],
            'nh1' => [
                'field' => 'water_metering_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер засобу обліку води №1',
            ],
            'nh2' => [
                'field' => 'water_metering_second',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер засобу обліку води №2',
            ],
            'np' => [
                'field' => 'watering_number',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер засобу обліку води для поливу',
            ],
            'ph1' => [
                'field' => 'previous_readings_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку №1',
            ],
            'ph2' => [
                'field' => 'previous_readings_second',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку №2',
            ],
            'pp' => [
                'field' => 'previous_watering_readings',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку для поливу',
            ],
            'dppp' => [
                'field' => 'date_previous_readings',
                'type' => static::TYPE_DATE,
                'title' => 'Дата надання попередніх показань',
            ],
            'namh1' => [
                'field' => 'type_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Тип засобу обліку №1',
            ],
            'namh2' => [
                'field' => 'type_second',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Тип засобу обліку №2',
            ],
            'namp' => [
                'field' => 'type_watering',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Тип засобу обліку для поливу',
            ],
            'datgos' => [
                'field' => 'verification_date',
                'type' => static::TYPE_DATE,
                'title' => 'Дата повірки',
            ],
            'srkub' => [
                'field' => 'medium_cubes',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Ознака середніх кубов',
            ],
            'khvsrn' => [
                'field' => 'number_medium_cubes',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Кількість середніх кубів',
            ]
        ];
    }

    public function tableFaild()
    {

        return [
            'account_number',
            'act_number',
            'water_metering_first',
            'water_metering_second',
            'watering_number',
            'previous_readings_first',
            'previous_readings_second',
            'previous_watering_readings',
            'date_previous_readings',
            'type_first',
            'type_second',
            'type_watering',
            'verification_date',
            'medium_cubes',
            'number_medium_cubes',
        ];

    }

    public function save()
    {


        foreach ($this->parser() as $item) {
            $scoreExist = WaterMetering::find()->where(['account_number' => $item['lic_schet']])->one();
            if ($item['ph1'] < $scoreExist->previous_readings_first) {
                continue;
            }
            $arr = array_combine($this->tableFaild(), $item);
            if ($scoreExist) {
                $scoreExist->updateAttributes($arr);
            } else {
                $score = new WaterMetering();
                $score->setAttributes($arr);
                if (!$score->save()) {
                    print_r($score);
                    print_r($score->getErrors());
//                    exit;
                    return false;
                } else {
//                    Yii::$app->queue->status(1);
                    print_r('ok');
                }
            }
        }
        return true;

//
//
//        Yii::$app->db->createCommand()->batchInsert('water_metering', [
//            'account_number', 'act_number', 'water_metering_first', 'water_metering_second',
//            'watering_number', 'previous_readings_first', 'previous_readings_second', 'previous_watering_readings',
//            'date_previous_readings', 'type_first', 'type_second', 'type_watering', 'verification_date',
//            'medium_cubes', 'number_medium_cubes',
//        ], $this->parser())->execute();
//
//        return true;
    }
}
