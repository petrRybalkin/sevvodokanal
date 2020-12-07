<?php

namespace common\dbfImport;

use common\models\Company;
use common\models\IndicationsAndCharges;
use common\models\Payment;
use common\models\WaterMetering;
use DateTime;
use Yii;
use yii\helpers\Json;

class PaymentDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'lic_schet' => [
                'field' => 'account_number',
                'type' => static::TYPE_STRING,
                'title' => 'Номер особового рахунку',
            ],
            'summa' => [
                'field' => 'sum',
                'type' => static::TYPE_FLOAT,
                'title' => 'Сума оплати',
            ],
            'datp' => [
                'field' => 'payment_date',
                'type' => static::TYPE_DATE,
                'title' => 'Дата платежу',
            ],
            'pr' => [
                'field' => 'pr',
                'type' => static::TYPE_STRING,
                'title' => '',
            ],

        ];
    }

    public function tableFaild()
    {
        return [
            'account_number', 'sum', 'payment_date', 'pr'];
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

                $dateNow = new DateTime($item['datp']);
                $dateThis = $dateNow->format('Y-m-01');
                $dateMonth = $dateNow->format('Y-m-31');

                Payment::deleteAll([
                    'AND',
                    'account_number' => $item['lic_schet'],
                    ['between', 'payment_date', $dateThis, $dateMonth],
                ]);

                $pay = new Payment();
                $pay->setAttributes($arr);

                if (!$pay->save()) {
                    $error .= 'строка - ' . $i . Json::encode($pay->getErrors()) . "\n";
                    continue;
                }

                $i++;

            } catch (\yii\db\Exception $e) {
                $i++;
                $this->log($admin_id, $e->getMessage());
                sleep(2);
            }
        }

        $this->log($admin_id,
            $error !== ''
                ? "Запись файла $fileName окончена. Ошибки - " . $error
                : "Запись файла $fileName окончена.");
        return true;


    }
}
