<?php

namespace common\dbfImport;

use common\models\ScoreMetering;
use Yii;

class ScoreDBF extends BaseDBF
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
            'fp' => [
                'field' => 'name_of_the_tenant',
                'type' => static::TYPE_STRING,
                'title' => 'ПІБ квартиронаймача',
            ],
            'adres' => [
                'field' => 'address',
                'type' => static::TYPE_STRING,
                'title' => 'Адреса',
            ],
            'norma' => [
                'field' => 'norm',
                'type' => static::TYPE_STRING,
                'title' => 'Норма',
            ],
            'type' => [
                'field' => 'type_of_housing',
                'type' => static::TYPE_STRING,
                'title' => 'Вид житла',
            ],
            'kol' => [
                'field' => 'registered_persons',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Кількість зареєстрованих осіб',
            ],
            'tarif' => [
                'field' => 'tariff_for_water',
                'type' => static::TYPE_FLOAT,
                'title' => 'Тариф по воді',
            ],
            'tarifst' => [
                'field' => 'tariff_for_stocks',
                'type' => static::TYPE_FLOAT,
                'title' => 'Тариф по стоках',
            ],
            'sumtarif' => [
                'field' => 'total_tariff',
                'type' => static::TYPE_FLOAT,
                'title' => 'Сумарний тариф',
            ]
        ];
    }

    public function tableFaild()
    {
        return [
            'account_number',
            'act_number',
            'name_of_the_tenant',
            'address',
            'norm',
            'type_of_housing',
            'registered_persons',
            'tariff_for_water',
            'tariff_for_stocks',
            'total_tariff'
        ];
    }

    public function save()
    {
//        \yii\helpers\VarDumper::dump($this->parser(),10,1);exit;

//        Yii::$app->db->createCommand()->batchInsert('score_metering', [
//            'account_number',
//            'act_number',
//            'name_of_the_tenant',
//            'address',
//            'norm',
//            'type_of_housing',
//            'registered_persons',
//            'tariff_for_water',
//            'tariff_for_stocks',
//            'total_tariff'
//        ], $this->parser())->execute();

        foreach ($this->parser() as $item) {
           $scoreExist = ScoreMetering::find()->where(['account_number' => $item['lic_schet']])->one();
            $arr =  array_combine($this->tableFaild() ,$item);
            if($scoreExist){
                $scoreExist->updateAttributes($arr);
            }else{
                $score = new ScoreMetering();
                $score->setAttributes($arr);
                $score->save();
            }
        }

    }


}
