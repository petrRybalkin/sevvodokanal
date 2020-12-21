<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $sinh
 * @property string $num_contract
 * @property string  $accounting_number
 * @property string|null $verification_date
 * @property float|null $previous_readings
 * @property float|null $current_readings
 * @property string|null $date_readings
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
            [['verification_date','previous_readings','accounting_number',
                'num_contract','date_readings','current_readings'], 'safe'],
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
