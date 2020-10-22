<?php

namespace common\dbfImport;

use common\models\Company;
use common\models\Payment;
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

        foreach ($this->parser() as $k => $item) {
            $arr =  array_combine($this->tableFaild() ,$item);
            $pay = new Payment();
            $pay->setAttributes($arr);
            if (!$pay->save(false)) {
                $error .= 'строка - '.$k.Json::encode($pay->getErrors());
                continue;
            } else {
                print_r('ok');
            }
        }
        $this->log($admin_id, $error !=='' ? "Запись файла $fileName окончена. Ошибки - ".$error :"Запись файла $fileName окончена." );
        return true;



    }
}
