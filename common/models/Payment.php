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


    public static function getLgota($account_number, $pr, $date = null)
    {
        $p = Payment::find()
            ->where([
                'account_number' => $account_number,
                'pr' => $pr,
            ]);

        if(!$p){
            return null;
        }

        if ($date) {
            $datew = new DateTime($date);
            $datek =  $datew->modify('+30 day')->format('Y-m-d');
            $p->andWhere(['between', 'payment_date', $date, $datek]);
        } else {
            $p->andWhere(new Expression('payment_date <= NOW() - INTERVAL 1 MONTH'));

        }

        $p->orderBy(['id' => SORT_DESC]);
        return $p->one();
    }

}
