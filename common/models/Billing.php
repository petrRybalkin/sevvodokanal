<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "billing".
 *
 * @property int $id
 * @property string|null $billIdentifier
 * @property string|null $payNumber
 * @property string|null $payId
 * @property string|null $totalSum
 * @property int|null $status
 * @property string|null $created_at
 */
class Billing extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAYED = 1;
    const STATUS_CANCEL = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'billing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['status'], 'default', 'value' => static::STATUS_NEW],
            [['created_at'], 'safe'],
            [['created_at'], 'default', 'value' => new Expression('NOW()')],
            [['billIdentifier'], 'string', 'max' => 13],
            [['payNumber', 'payId', 'totalSum'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billIdentifier' => 'Bill Identifier',
            'payNumber' => 'Pay Number',
            'payId' => 'Pay ID',
            'totalSum' => 'Total Sum',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
