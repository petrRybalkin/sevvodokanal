<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string|null $account_number
 * @property float|null $sum
 * @property string|null $payment_date
 * @property string|null $pr
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum'], 'number'],
            [['payment_date'], 'safe'],
            [['account_number'], 'string', 'max' => 13],
            [['pr'], 'string', 'max' => 10],
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
            'sum' => 'Sum',
            'payment_date' => 'Payment Date',
            'pr' => 'Pr',
        ];
    }
}