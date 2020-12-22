<?php

namespace frontend\controllers;

use common\models\Billing;
use common\models\Payment;
use common\models\ScoreMetering;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;

class PbController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'pbch' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionPbch()
    {
        $xml = simplexml_load_string(Yii::$app->request->getRawBody(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = Json::encode($xml);
        $data = Json::decode($json);
        $action = ArrayHelper::getValue($data, '@attributes.action', 'Wrong action');

        if (!$this->checkIp()) {
            return $this->error($action, 5);
        }

        switch ($action) {
            case 'Search':
                return $this->aSearch($data['Data']);
            case 'Check':
                return $this->aCheck($data['Data']);
            case 'Pay':
                return $this->aPay($data['Data']);
            case 'Cancel':
                return $this->aCancel($data['Data']);
        }
        return $action;
    }

    private function billExist($billIdentifier)
    {
        return ScoreMetering::find()->where([
            'account_number' => $billIdentifier,
        ])->one();
    }

    private function aSearch($data)
    {
        $billIdentifier = ArrayHelper::getValue($data, 'Unit.@attributes.value', 0);
        $bill = $this->billExist($billIdentifier);
        return $bill
            ? $this->render('search', [
                'id' => $billIdentifier,
                'fio' => $bill->name_of_the_tenant,
            ])
            : $this->error('Search', 2);
    }

    private function aCheck($data)
    {
        $payNumber = ArrayHelper::getValue($data, '@attributes.number', 0);
        $payId = ArrayHelper::getValue($data, '@attributes.id', 0);
        $billIdentifier = ArrayHelper::getValue($data, 'PayerInfo.@attributes.billIdentifier', 0);
        $totalSum = ArrayHelper::getValue($data, 'TotalSum', 0);

        $bill = $this->billExist($billIdentifier);
        if (!$bill) {
            return $this->error('Check', 2);
        }

        $billing = new Billing();
        $billing->billIdentifier = $billIdentifier;
        $billing->payNumber = $payNumber;
        $billing->payId = $payId;
        $billing->totalSum = $totalSum;
        if (!$billing->save()) {
            return $this->error('Check', 99, Json::encode($billing->errors));
        }

        return $this->render('check', [
            'id' => $billing->id,
        ]);
//        return Json::encode($data);
    }

    private function aPay($data)
    {
        $payNumber = ArrayHelper::getValue($data, '@attributes.number', 0);
        $payId = ArrayHelper::getValue($data, '@attributes.id', 0);
        $billIdentifier = ArrayHelper::getValue($data, 'PayerInfo.@attributes.billIdentifier', 0);
        $totalSum = ArrayHelper::getValue($data, 'TotalSum', 0);

        $billing = Billing::findOne([
            'payNumber' => $payNumber,
            'payId' => $payId,
            'billIdentifier' => $billIdentifier,
            'totalSum' => $totalSum,
        ]);
        if (!$billing) {
            return $this->error('Pay', 2);
        }

        $payment = new Payment();
        $payment->account_number = $billIdentifier;
        $payment->sum = $totalSum;
        $payment->pr = 1;
        $payment->payment_date = new Expression('NOW()');
        if (!$payment->save()) {
            return $this->error('Pay', 99, Json::encode($payment->errors));
        }

        $billing->updateAttributes([
            'status' => Billing::STATUS_PAYED,
        ]);

        return $this->render('pay', [
            'id' => $billing->id,
        ]);
    }

    private function aCancel($data)
    {
        $payId = ArrayHelper::getValue($data, '@attributes.id', 0);
        $billIdentifier = ArrayHelper::getValue($data, 'PayerInfo.@attributes.billIdentifier', 0);
        $totalSum = ArrayHelper::getValue($data, 'TotalSum', 0);

        $billing = Billing::findOne([
            'payId' => $payId,
            'billIdentifier' => $billIdentifier,
            'totalSum' => $totalSum,
        ]);
        if (!$billing) {
            return $this->error('Pay', 2);
        }
        $billing->updateAttributes([
            'status' => Billing::STATUS_CANCEL,
        ]);

        return $this->render('cancel', [
            'id' => $billing->id,
        ]);

//        return Json::encode($data);
    }

    private function error($action, $code, $message = '')
    {
        $messages = [
            1 => 'Неизвестный тип запроса',
            2 => 'Абонент не найден',
            3 => 'Ошибка в формате денежной суммы (“Сумма платежа” или “Сумма к оплате”)',
            4 => 'Неверный формат даты',
            5 => 'Доступ с данного IP не предусмотрен',
            6 => 'Найдено более одного плательщика. Уточните параметр поиска.',
            7 => 'Дублирование платежа.Запись по данному платежу больше не формировать.',
            8 => 'Критическая ошибка. Запись по данному платежу больше не формировать',
//            99 => 'Другая ошибка провайдера (Можно указать любое другое сообщение)',
        ];

        return $this->render('error', [
            'action' => $action,
            'code' => $code,
            'message' => ArrayHelper::getValue($messages, $code, $message)
        ]);
    }

    private function checkIp()
    {
        $ip = Yii::$app->getRequest()->getUserIP();
        $whitelist = [
            '172.19.0.1',
            '31.128.100.203',
            '217.117.64.232',
            '217.117.68.232'
        ];
        return in_array($ip, $whitelist, true);
    }

    public function actionIp() {
        echo Yii::$app->getRequest()->getUserIP();
    }
}
