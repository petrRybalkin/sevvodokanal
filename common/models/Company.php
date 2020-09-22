<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $num_contract
 * @property int  $accounting_number
 * @property string|null $verification_date
 * @property float|null $previous_readings
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accounting_number', 'num_contract', 'previous_readings'], 'number'],
            [['verification_date'], 'safe'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_contract' => 'Num Contract',
            'accounting_number' => 'Accounting Number',
            'verification_date' => 'Verification Date',
            'previous_readings' => 'Previous Readings',
        ];
    }
}
