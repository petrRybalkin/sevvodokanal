<?php

namespace common\models;

use DateTime;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string|null $account_number
 * @property float|null $sum
 * @property string|null $payment_date
 * @property int|null $pr
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
            [['sum'], 'safe'],
            [['payment_date', 'account_number'], 'safe'],
//            [['account_number'], 'string', 'max' => 13],
            [['pr'], 'safe'],
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


    public static function getLgotas($account_number, $date = null, $asArray = false)
    {
        return [
            static::getLgota($account_number, 0, $date, $asArray),
            static::getLgota($account_number, 1, $date, $asArray),
            static::getLgota($account_number, 2, $date, $asArray),
            static::getLgota($account_number, 3, $date, $asArray),
        ];
    }

    public static function getLgota($account_number, $pr, $date = null, $asArray = false)
    {
        $p = Payment::find()
            ->select(new Expression('id, account_number, pr, sum, SUM(sum) as sumAll'))
            ->where([
                'account_number' => $account_number,
                'pr' => $pr,
            ]);

        if(!$p){
            return null;
        }

        if ($date) {
            $datew = new DateTime($date);
            $datek =  $datew->modify('+1 month -1 day' )->format('Y-m-d');

            $p->andWhere(['between', 'payment_date', $date, $datek]);
        } else {
//          для счета  дату предыдущего мес
            $date = date('Y-m-01');
            $datew = new DateTime($date);
            $datek =  $datew->modify('-1 month' )->format('Y-m-d');
            $p->andWhere(['between', 'payment_date', $datek,  $date]);// все оплаты за предыдущ мес

        }

        if($asArray){
           return  $p->asArray()->one();
        }

        return $p->one();
    }

}
