<?php

namespace common\dbfImport;


use common\models\IndicationsAndCharges;
use common\queue\BaseJob;
use DateTime;
use Yii;
use yii\helpers\Json;

//Довідник нарахувань та показань для фізичних осіб
//При первинній загрузці файлу по нарахуванням та показанням для фізичних осіб буде містити всю інформацію по
// нарахуванням та показанням за 3 роки.
//При подальшому завантаженні файл буде містити дані по нарахуванню та показанню тільки за поточний місяць.


class IndicationsAndChargesDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'lic_schet' => [
                'field' => 'account_number',
                'type' => static::TYPE_STRING,
                'title' => 'Номер особового рахунку',
            ],
            'mes' => [
                'field' => 'month_year',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Місяць та Рік',
            ],
            'lgo' => [
                'field' => 'privilege',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Наявність пільги',
            ],
            'kol' => [
                'field' => 'count',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Кількість зареєстрованих осіб',
            ],
            'hsal' => [
                'field' => 'debt_begin_month',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Заборгованість на початок місяця',
            ],
            'ph1' => [
                'field' => 'previous_readings_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку № 1',
            ],
            'th1' => [
                'field' => 'current_readings_first',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Поточні показання засобу обліку № 1',
            ],
            'ph2' => [
                'field' => 'previous_readings_second',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку № 2',
            ],
            'th2' => [
                'field' => 'current_readings_second',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Поточні показання засобу обліку № 2',
            ],
            'pp' => [
                'field' => 'previous_readings_watering',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання засобу обліку для поливу',
            ],
            'tp' => [
                'field' => 'current_readings_watering',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Поточні показання засобу обліку для поливу',
            ],
            'khv' => [
                'field' => 'water_consumption',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Обсяг водоспоживання по воді',
            ],
            'kpv' => [
                'field' => 'watering_consumption',
                'type' => static::TYPE_NUMERIC,
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
                'type' => static::TYPE_NUMERIC,
                'title' => 'Корекція',
            ],
            'hsumma' => [
                'field' => 'debt_end_month',
                'type' => static::TYPE_FLOAT,
                'title' => 'Заборгованість на кінець місяця',
            ],
            'srkub' => [
                'field' => 'medium_cubes',
                'type' => static::TYPE_STRING,
                'title' => 'Ознака середніх кубов',
            ],
            'synch' => [
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

    public function save($admin_id, $fileName)
    {
        $error = '';
        $str = $this->getRecordCount();
        $this->log($admin_id, "Запись начата $str строк. Файл - $fileName");
        $i = 0;

        while ($item = $this->nextRecord()) {
            try {

                if($i % 2000 == 0){
                    sleep(5);
                    $this->log($admin_id, "ok  $i - " . $item['lic_schet']);
                }

                $this->checkDbConnection();
                $arr = array_combine($this->tableFaild(), $item);

                IndicationsAndCharges::deleteAll([
                    'account_number' => $item['lic_schet'],
                    'month_year' => $item['mes'],
                ]);

                $score = new IndicationsAndCharges();
                $score->setAttributes($arr, false);
                $score->setAttributes(['synchronization' => 0]);

                if (!$score->save()) {
                    $error .= 'строка - ' . $i .'счет - '.$item['lic_schet'].'.  '. Json::encode($score->getErrors()) . "\n";
                    continue;
                }

                $i++;

            } catch (\yii\db\Exception $e) {
                $i++;
                $this->log($admin_id, 'строка - ' . $i .'счет - '.$item['lic_schet'].'.'.$e->getMessage());
                sleep(2);
            }
        }

        $this->log($admin_id, $error !== ''
            ? "Запись файла $fileName  окончена. Ошибки - " . $error
            : " Запись файла $fileName окончена.");
        return true;

    }


}
