<?php

namespace common\dbfImport;

use common\models\ScoreMetering;
use Yii;
use yii\db\Command;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

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

    public function save($admin_id, $fileName)
    {

        $error = '';
        $str = $this->getRecordCount();
        $this->log($admin_id, "Запись начата $str строк. Файл - $fileName");

        foreach ($this->parser() as $item) {
            $scoreExist = ScoreMetering::find()->where(['account_number' => $item['lic_schet']])->one();

            $arr = array_combine($this->tableFaild(), $item);
            if ($scoreExist) {
                $scoreExist->updateAttributes($arr);
            } else {
                $score = new ScoreMetering();
                $score->setAttributes($arr);
                if (!$score->save()) {
                    $error .= Json::encode($score->getErrors());
                    continue;
                } else {
                    print_r('ok');
                }
            }
        }
        $this->log($admin_id, $error !=='' ? "Запись файла $fileName окончена. Ошибки - ".$error :"Запись файла $fileName окончена." );
        return true;
    }


}
