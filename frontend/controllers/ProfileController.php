<?php

namespace frontend\controllers;

use common\models\ClientMap;
use yii\filters\AccessControl;
use common\models\IndicationsAndCharges;
use common\models\Payment;
use common\models\ScoreMetering;
use common\models\WaterMetering;
use common\queue\PhpWordJob;
use frontend\models\IndicationForm;
use frontend\models\ScoreForm;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ProfileController extends Controller
{
    public $layout = 'main-profile';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'account-number', 'payment', 'score', 'history', 'word', 'water-metering'],
                'rules' => [
                    [
                        'actions' => ['index', 'account-number', 'payment', 'score', 'history', 'word', 'water-metering'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ScoreForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('add-score-button')) {
                $clientMap = ClientMap::find()->where(['client_id' => Yii::$app->user->getId()]);
                if ($clientMap->count() == 5) {
                    Yii::$app->session->setFlash('danger', 'Можна додати не бiльш 5 особових рахункiв.');
                    return $this->redirect(Yii::$app->request->referrer);
                }

                $score = ScoreMetering::find()->where(['account_number' => $model->account_number]);

                if ($clientMap->andWhere(['score_id' => $score->one()->id])->exists()) {
                    Yii::$app->session->setFlash('danger', 'Цей рахунок вже додано.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if (empty($model->act_number) && empty($model->sum)) {
                    Yii::$app->session->setFlash('danger', 'Треба заповнити хоча б одне з полів "Номер акту" або "Сума".');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if ($model->act_number) {
                    $score->andWhere(['act_number' => $model->act_number]);
                }
                if ($model->sum) {
                    $sum = Payment::find()->where(['account_number' => $model->account_number])->orderBy(['id' => SORT_DESC])->one();
                    if (!$sum || str_replace(',', '.', $model->sum) + 0 !== $sum->sum) {
                        Yii::$app->session->setFlash('danger', 'Невірна сума оплати - можливо, Ви помилились при вводі суми оплати.');
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                }
                if (!$score = $score->one()) {
                    Yii::$app->session->setFlash('danger', 'Перевірте введені дані.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                $add = ClientMap::addClientMap(Yii::$app->user->getId(), $score->id);
                if ($add !== true) {
                    Yii::$app->session->setFlash('danger', $add[0]);
                    return $this->redirect(Yii::$app->request->referrer);
                }
                Yii::$app->session->setFlash('success', 'Особовий рахунок додано.');
                return $this->redirect(Yii::$app->request->referrer);


            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

        }
        $clientScore = ClientMap::find()->select('score_id')->where(['client_id' => Yii::$app->user->getId()])->column();

        return $this->render('index', [
            'model' => $model,
            'clientScore' => ScoreMetering::find()->where(['id' => $clientScore])->all()
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteNumber($id)
    {
        $n = ClientMap::find()->where(['client_id' => Yii::$app->user->getId(), 'score_id' => $id])->one();
        if (!$n->delete()) {
            Yii::$app->session->setFlash('danger', 'Не вдалося видалити рахунок.');
        }
        Yii::$app->session->setFlash('success', 'Рахунок видалено.');
        return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     * @param $id
     * @return string
     */
    public function actionAccountNumber($id)
    {
        $number = ScoreMetering::find()->where(['id' => $id])->one();
        return $this->render('account-number', [
            'number' => $number
        ]);

    }

    /**
     * @param $id
     * @return string
     */
    public function actionWaterMetering($id)
    {
        $number = ScoreMetering::find()->where(['id' => $id])->one();


        return $this->render('water-metering', [
            'number' => $number,

        ]);

    }

    /**
     * @return array|string|Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionMeter()
    {
        $model = new IndicationForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('add-meter-button')) {
                $indication = IndicationsAndCharges::find()->where(['account_number' => $model->acc])->orderBy(['id' => SORT_DESC])->one();
                $score = ScoreMetering::find()->where(['account_number' => $model->acc])->orderBy(['id' => SORT_DESC])->one();
//                if ($indication && strtotime($indication->month_year) < strtotime(Yii::$app->formatter->asDate(('NOW'), 'php:Ym'))) {
                $indication->id = null;
                $indication->isNewRecord = true;
                $indication->updateAttributes([
                    'previous_readings_first' => $indication->current_readings_first,
                    'previous_readings_second' => $indication->current_readings_second,
                    'previous_readings_watering' => $indication->current_readings_watering,

                ]);
//                }

                if (!$indication) {
                    $indication = new  IndicationsAndCharges();
                }

                if ($model->meter1 && $model->number1) {
                    $wm = WaterMetering::find()->where(['water_metering_first' => $model->number1])->one();
                    $indication->updateAttributes([
                        'current_readings_first' => $model->meter1,
                    ]);
                    $wm->updateAttributes(['previous_readings_first' => (int)$model->meter1]);
                }

                if ($model->meter2 && $model->number2) {
                    $wm = WaterMetering::find()->where(['water_metering_second' => $model->number2])->one();
                    $indication->updateAttributes([
                        'current_readings_second' => $model->meter2,

                    ]);
                    $wm->updateAttributes(['previous_readings_second' => (int)$model->meter2]);
                }
                if ($model->number3 && $model->meter3) {
                    $wm = WaterMetering::find()->where(['watering_number' => $model->number3])->one();
                    $indication->updateAttributes(['current_readings_watering' => $model->meter3,

                    ]);
                    $wm->updateAttributes(['previous_watering_readings' => (int)$model->meter3]);
                }
                $wc = ((int)$model->meter1 - (int)$indication->previous_readings_first)
                    + ((int)$model->meter2 - (int)$indication->previous_readings_second);
                $watc = (int)$model->meter3 - (int)$indication->previous_readings_watering;
                $indication->updateAttributes([
                    'account_number' => $wm->account_number,
                    'month_year' => Yii::$app->formatter->asDate(('NOW'), 'php:Ym'),
                    'synchronization' => 1,
                    'water_consumption' => $wc,
                    'watering_consumption' => $watc,
                    'accruals' => ($wc + $watc) * $indication->total_tariff,
                    'debt_end_month' => (($indication->current_readings_first +
                                $indication->current_readings_second +
                                $indication->current_readings_watering -
                                $indication->previous_readings_first -
                                $indication->previous_readings_second -
                                $indication->previous_readings_watering) * $score->tariff_for_water) +
                        (($indication->current_readings_first +
                                $indication->current_readings_second -
                                $indication->previous_readings_first -
                                $indication->previous_readings_second) * $score->tariff_for_stocks)
                ]);
                $wm->updateAttributes(['date_previous_readings' => Yii::$app->formatter->asDate(('NOW'), 'php:Y-m-d')]);
                if (!$indication->save() || !$wm->save()) {
                    Yii::$app->session->setFlash('danger', 'Показання не збереженi. Виникла помилка.');
                } else {
                    Yii::$app->session->setFlash('success', 'Показання переданi.');
                }

                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

        }

        return $this->render('water-metering-form', [
            'model' => $model
        ]);

    }

    /**
     * @param $id
     * @return string
     */
    public function actionScore($id)
    {
        $score = ScoreMetering::find()->where(['id' => $id])->one();
        $metering = WaterMetering::find()->where(['account_number' => $score->account_number])->orderBy(['id' => SORT_DESC])->one();
        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->orderBy(['id' => SORT_DESC])->one();
        $payment = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->all();

        return $this->render('score', [
            'score' => $score,
            'indication' => $indication,
            'metering' => $metering,
            'payment' => $payment
        ]);

    }

    /**
     * @param $id
     * @return string
     */
    public function actionHistory($id)
    {
        $score = ScoreMetering::find()->where(['id' => $id])->one();
        $metering = WaterMetering::find()->where(['account_number' => $score->account_number])->all();
        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->groupBy('month_year')->all();


        return $this->render('history', [
            'metering' => $metering,
            'score' => $score,
            'indication' => $indication,

        ]);

    }

    /**
     * @param $id
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionWord($id)
    {
        $score = ScoreMetering::find()->where(['id' => $id])->one();
        $metering = WaterMetering::find()->where(['account_number' => $score->account_number])->orderBy(['id' => SORT_DESC])->one();
        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->orderBy(['id' => SORT_DESC])->one();
        FileHelper::createDirectory(\Yii::getAlias('@runtimeFront') . '/history/');
        $date = Yii::$app->formatter->asDate(('NOW'), 'php:Ymd');
        $name = 'Нарахування та показання' . ($score->name_of_the_tenant ?: '_') . '_' . $date . '.docx';
        $fullName = \Yii::getAlias('@runtimeFront') . '/history/' . $name;
        if ($score && $metering && $indication) {
            $id = Yii::$app->queue->push(new PhpWordJob([
                'template' => $_SERVER['DOCUMENT_ROOT'] . "/template/template-history.docx",
                'path' => $fullName,
                'search' => [
                    'account_number',
                    'act_number',
                    'fio',
                    'address',
                    'norm',
                    'total_tarif',
                    'water',
                    'watering',
                    'verification_date',
                    'exist_lgota',
                    'date_debt',
                    'debt',
                    'accruals',
                    'privelege_unpaid',
                    'lgota',
                    'current_pay',
                    'perescore',
                    'date_pay',
                    'payment',
                    'total_payment'

                ],
                'replace' => [
                    $score->account_number,
                    $score->act_number,
                    $score->name_of_the_tenant,
                    $score->address,
                    $score->norm,
                    $score->total_tariff,
                    $indication->current_readings_first + $indication->current_readings_second - $indication->previous_readings_first - $indication->previous_readings_second,
                    $indication->current_readings_watering - $indication->previous_readings_watering,
                    Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y'),
                    $indication->privilege == 0 ? 'Нi' : "Так",
                    date("m.Y", strtotime(substr($indication->month_year, 0, 4) . "-" . substr($indication->month_year, 4, 6) . '-01  first day of last month')),
                    $indication->debt_end_month,
                    $indication->accruals,
                    $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2),
                    Payment::getLgota($score->account_number, 3) ?: '-',
                    Payment::getLgota($score->account_number, 1) ? Payment::getLgota($score->account_number, 1)->sum : '0',
                    $indication->correction,
                    date('01.m.Y') ,
                    $indication->accruals -
                    $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2) -
                        Payment::getLgota($score->account_number, 3),
                    $indication->debt_end_month

                ],
            ]));
        }
        $startTime = time();
        while (!Yii::$app->queue->isDone($id)) {
            sleep(1);
            if (time() - $startTime > 100) {
                return Yii::$app->session->setFlash('danger', 'Не вдалося сформувати документ');
            }
        }
        Yii::$app->response->sendFile($fullName);
        return Yii::$app->response->send();
    }


    /**
     * @param $id
     * @param ProfileController $profileController
     * @return string
     */
    public function actionPayment($id)
    {

        $xml =
            '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Presearch">
	<Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Payer">
		<Unit name="ls" value="0914102110970" />
	</Data>
</Transfer>';


        $url = "https://next.privat24.ua/payments/form/";
//        $url = "https://api.privatbank.ua/p24api/rest_fiz";form/{'token':'85d7538541314874e34920bd9d5abfedawkh6xft','personalAccount':'0914102110970'}

        $post = [
            'argstr' => "token:85d7538541314874e34920bd9d5abfedawkh6xft,personalAccount:0914102110970",
        ];
        $headers = array(
            "Content-type: text/xml",
            "Content-length: " . strlen($xml),
            "Connection: close",
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, http_build_query($post));
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


        $data = curl_exec($ch);
        if (curl_errno($ch))
            print curl_error($ch);
        else
            curl_close($ch);

        return $this->render('payment', [
        ]);

    }
}
