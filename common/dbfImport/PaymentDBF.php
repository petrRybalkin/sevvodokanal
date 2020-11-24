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

        foreach ($this->parser() as $k => $item) {
            $arr =  array_combine($this->tableFaild() ,$item);

//            $payExist = Payment::find()->where(['account_number' => $item['lic_schet']])->one();

            $dateNow = new DateTime('now');
            $dateMonth =  $dateNow->modify('+1 month')->format('Y-m-d');
            $payment = Payment::find()
                ->where(['account_number' => $item['lic_schet']])
                ->andWhere(['between', 'month_year', $dateNow->format('Y-m-d'), $dateMonth])
                ->all();

            if ($payment) {
                foreach ($payment as $p) {
                    if(!$p->delete()){
                        $error .= 'строка - ' . $k . Json::encode($p->getErrors()) . "\n";
                    }
                    print_r('delete' . "\n");
                }

            }
//            if($payExist){
//                if (!$payExist->delete()) {
//                    $error .= 'строка - ' . $k . Json::encode($payExist->getErrors()) . "\n";
//                }
//                print_r('delete' . "\n");
//            }

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
