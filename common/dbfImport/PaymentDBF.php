<?php

namespace common\dbfImport;

use Yii;

class PaymentDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'lic_schet' => [
                'field' => 'account_number',
                'type' => static::TYPE_NUMERIC,
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
                'type' => static::TYPE_NUMERIC,
                'title' => '',
            ],

        ];
    }

    public function save()
    {
        Yii::$app->db->createCommand()->batchInsert('payment', [
            'account_number', 'sum', 'payment_date', 'pr'], $this->parser(5))->execute();
    }
}
