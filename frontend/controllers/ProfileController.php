<?php

namespace frontend\controllers;

use common\models\ClientMap;
use DateTime;
use yii\data\Pagination;
use yii\db\Expression;
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
                    Yii::$app->session->setFlash('error', 'Можна додати не бiльш 5 особових рахункiв.');
                    return $this->redirect(Yii::$app->request->referrer);
                }

                $score = ScoreMetering::find()->where(['account_number' => $model->account_number]);

                if ($clientMap->andWhere(['score_id' => $score->one()->id])->exists()) {
                    Yii::$app->session->setFlash('error', 'Цей рахунок вже додано.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if (empty($model->act_number) && empty($model->sum)) {
                    Yii::$app->session->setFlash('error', 'Треба заповнити хоча б одне з полів Номер акту або Сума.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                if ($model->act_number) {
                    $score->andWhere(['act_number' => $model->act_number]);
                }
                if ($model->sum) {
                    $sum = Payment::find()->where(['account_number' => $model->account_number])->orderBy(['id' => SORT_DESC])->one();
                    if (!$sum || str_replace(',', '.', $model->sum) + 0 !== $sum->sum) {
                        Yii::$app->session->setFlash('error', 'Невірна сума оплати - можливо, Ви помилились при вводі суми оплати.');
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                }
                if (!$score = $score->one()) {
                    Yii::$app->session->setFlash('error', 'Перевірте введені дані.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                $add = ClientMap::addClientMap(Yii::$app->user->getId(), $score->id);
                if ($add !== true) {
                    Yii::$app->session->setFlash('error', $add[0]);
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
            Yii::$app->session->setFlash('error', 'Не вдалося видалити рахунок.');
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
                if (!$model->validate()) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                $dThis = new DateTime('first day of this month');
                $indicationThisMonth = IndicationsAndCharges::find()
                    ->where(['account_number' => $model->acc])
                    ->andWhere(['month_year' => $dThis->format('Ym')])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();

                $dPrev = new DateTime('first day of last month');
                $indicationPrevMonth = IndicationsAndCharges::find()
                    ->where(['account_number' => $model->acc])
                    ->andWhere(['month_year' => $dPrev->format('Ym')])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();


                $score = ScoreMetering::find()->where(['account_number' => $model->acc])->orderBy(['id' => SORT_DESC])->one();
//                if ($indication && strtotime($indication->month_year) < strtotime(Yii::$app->formatter->asDate(('NOW'), 'php:Ym'))) {
//                $indication->id = null;
//                $indication->isNewRecord = true;
                $indicationThisMonth->updateAttributes([
                    'previous_readings_first' => $indicationPrevMonth->current_readings_first,
                    'previous_readings_second' => $indicationPrevMonth->current_readings_second,
                    'previous_readings_watering' => $indicationPrevMonth->current_readings_watering,

                ]);
//                }
//                if (!$indication) {
//                    $indication = new  IndicationsAndCharges();
//                }
                if ($model->meter1 && $indicationThisMonth->water) {
                    $wm = WaterMetering::find()
                        ->where(['water_metering_first' => $indicationThisMonth->water->water_metering_first])
                        ->one();

                    $indicationThisMonth->updateAttributes([
                        'current_readings_first' => (int)$model->meter1,
                    ]);
                    $wm->updateAttributes(['previous_readings_first' => (int)$model->meter1]);
                }

                if ($model->meter2 && $indicationThisMonth->water) {
                    $wm = WaterMetering::find()
                        ->where(['water_metering_second' => $indicationThisMonth->water->water_metering_second])
                        ->one();

                    $indicationThisMonth->updateAttributes([
                        'current_readings_second' => (int)$model->meter2,

                    ]);
                    $wm->updateAttributes(['previous_readings_second' => (int)$model->meter2]);
                }
                if ($model->meter3 && $indicationThisMonth->water) {
                    $wm = WaterMetering::find()
                        ->where(['watering_number' => $indicationThisMonth->water->watering_number])
                        ->one();
                    $indicationThisMonth->updateAttributes([
                        'current_readings_watering' => (int)$model->meter3]);

                    $wm->updateAttributes(['previous_watering_readings' => (int)$model->meter3]);
                }
                $wc = ((int)$model->meter1 - (int)$indicationThisMonth->previous_readings_first)
                    + ((int)$model->meter2 - (int)$indicationThisMonth->previous_readings_second);


                $watc = (int)$model->meter3 - (int)$indicationPrevMonth->previous_readings_watering;
                $calcWaterCons = (((int)$model->meter1 +
                            (int)$model->meter2 +
                            (int) $model->meter3 -
                            $indicationThisMonth->previous_readings_first -
                            $indicationThisMonth->previous_readings_second -
                            $indicationThisMonth->previous_readings_watering) * $score->tariff_for_water) +
                    (((int)$model->meter1 +
                            (int)$model->meter2 -
                            $indicationThisMonth->previous_readings_first -
                            $indicationThisMonth->previous_readings_second) * $score->tariff_for_stocks);


                $splacheno = (Payment::getLgota($score->account_number, 1, date('Y-m-d'), true)
                        ? Payment::getLgota($score->account_number, 1, date('Y-m-d'), true)['sumAll'] : 0) +
                    (Payment::getLgota($score->account_number, 0, date('Y-m-d'), true)
                        ? Payment::getLgota($score->account_number, 0, date('Y-m-d'), true)['sumAll']
                        : 0);
                $lgo = $indicationThisMonth->privilege_unpaid !== 0
                    ? $indicationThisMonth->privilege_unpaid
                    : Payment::getLgota($score->account_number, 2, date('Y-m-d'), true)['sumAll'];

                $subs = Payment::getLgota($score->account_number, 3, date('Y-m-d'), true)
                    ? Payment::getLgota($score->account_number, 3, date('Y-m-d'), true)['sumAll']
                    : 0;
                /** @var IndicationsAndCharges $indicationPrevMonth */
                /** @var IndicationsAndCharges $indicationThisMonth */
                $indicationThisMonth->updateAttributes([
                    'account_number' => $wm->account_number,
                    'month_year' => Yii::$app->formatter->asDate(('NOW'), 'php:Ym'),
                    'synchronization' => 1,
                    'water_consumption' => $wc,
                    'watering_consumption' => $watc,
                    'accruals' => $calcWaterCons,
                    //   слаьдо на поч мес + то что вверху - кор тек - сплачено тек- субс тек -пильг тек +
                    'debt_end_month' => $indicationThisMonth->debt_begin_month + $calcWaterCons - $indicationThisMonth->correction
                        - $splacheno - $lgo - $subs

                ]);
                $wm->updateAttributes([
                    'date_previous_readings' => Yii::$app->formatter->asDate(('NOW'), 'php:Y-m-d'),
                    'in_site' => 1
                ]);

                if (!$indicationThisMonth->save() || !$wm->save()) {
                    Yii::$app->session->setFlash('error', 'Показання не збереженi. Виникла помилка.');
                } else {
                    Yii::$app->session->setFlash('success', 'Показання переданi.');
                }

                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

        }

        return $this->render('water-metering', [
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

//      выбрать предыдущий мес +
        $d = new DateTime('first day of last month');
        $indication = IndicationsAndCharges::find()
            ->where(['account_number' => $score->account_number])
            ->andWhere(['month_year' => $d->format('Ym')])
            ->orderBy(['id' => SORT_DESC])->one();
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
//        $metering = WaterMetering::find()->where(['account_number' => $score->account_number])->all();
//        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->groupBy('month_year')->all();


        $query = IndicationsAndCharges::find()
            ->where(['account_number' => $score->account_number])
            ->groupBy('month_year');
//        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);

        $indication = $query->offset($pages->offset)
            ->orderBy('month_year ASC')
            ->limit($pages->limit)
            ->all();

        return $this->render('history', [
            'indication' => $indication,
            'pages' => $pages,
//            'metering' => $metering,
            'score' => $score,
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
        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])
            ->andWhere(['month_year' => date("Ym", strtotime('first day of last month'))])->one();
        FileHelper::createDirectory(\Yii::getAlias('@runtimeFront') . '/history/');
        $date = Yii::$app->formatter->asDate(('NOW'), 'php:d-m-Y');
        $name = 'Рахунок_' . $score->name_of_the_tenant . '_' . $date . '.docx';
        $fullName = \Yii::getAlias('@runtimeFront') . '/history/' . $name;

        if ($score && $indication) {
            $lgota = $indication->privilege_unpaid !== 0
                ? $indication->privilege_unpaid
                : Payment::getLgota($score->account_number, 2, null, true)['sumAll'];
            $subs = Payment::getLgota($score->account_number, 3, null, true)
                ? Payment::getLgota($score->account_number, 3, null, true)['sumAll']
                : 0;
            $opl1 = Payment::getLgota($score->account_number, 1, null, true)
                ? Payment::getLgota($score->account_number, 1, null, true)['sumAll']
                : 0;

            $opl0 = Payment::getLgota($score->account_number, 0, null, true)
                ? Payment::getLgota($score->account_number, 0, null, true)['sumAll']
                : 0;

            $d = IndicationsAndCharges::debtBeginMonth($indication->account_number,
                date("d.m.Y", strtotime('first day of last month')));
            if ($metering) {
                $search = [
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

                ];

                $replace = [
                    $score->account_number,//account_number
                    $score->act_number,//act_number
                    $score->name_of_the_tenant,//fio
                    $score->address,//address
                    $score->norm,//norm
                    $score->total_tariff . ' грн.',//total_tarif
                    $indication->water_consumption,//water
                    $indication->watering_consumption,//watering
                    Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y'),//verification_date
                    $indication->privilege == 0 ? 'Нi' : "Так",//exist_lgota
                    date("d.m.Y", strtotime('first day of last month')),//date_debt
                    Yii::$app->formatter->asDecimal($d ? $d->debt_begin_month : 0, 2) . ' грн.',//debt
                    Yii::$app->formatter->asDecimal($indication->accruals, 2) . ' грн.',//accruals
                    Yii::$app->formatter->asDecimal($lgota ?: 0, 2) ?: '-' . ' грн.',//privelege_unpaid
                    Yii::$app->formatter->asDecimal($subs ?: 0, 2) ?: '-' . ' грн.',//lgota
                    Yii::$app->formatter->asDecimal($opl1 + $opl0, 2) ?: '0' . ' грн.',//current_pay
                    Yii::$app->formatter->asDecimal($indication->correction ?: 0, 2) . ' грн.',//perescore
                    date('01.m.Y'),//date_pay
                    Yii::$app->formatter->asDecimal($indication->debt_end_month ?: 0, 2) . ' грн.',//payment
                    Yii::$app->formatter->asDecimal($indication->debt_end_month ?: 0, 2) . ' грн.'//total_payment

                ];

                $template = $_SERVER['DOCUMENT_ROOT'] . "/template/template-history-metering.docx";
            } else {
                $search = [
                    'account_number',
                    'fio',
                    'address',
                    'norm',
                    'total_tarif',
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

                ];

                $replace = [
                    $score->account_number, //account_number
                    $score->name_of_the_tenant,//fio
                    $score->address,//address
                    $score->norm,//norm
                    $score->total_tariff . ' грн.',//total_tarif
                    $indication->privilege == 0 ? 'Нi' : "Так",//exist_lgota
                    date("d.m.Y", strtotime('first day of last month')),//date_debt
                    Yii::$app->formatter->asDecimal($d ? $d->debt_begin_month : 0, 2) . ' грн.',//debt
                    Yii::$app->formatter->asDecimal($indication->accruals, 2) . ' грн.',//accruals
                    Yii::$app->formatter->asDecimal($lgota ?: 0, 2) ?: '-' . ' грн.',//privelege_unpaid
                    Yii::$app->formatter->asDecimal($subs ?: 0, 2) ?: '-' . ' грн.',//lgota
                    Yii::$app->formatter->asDecimal($opl1 + $opl0, 2) ?: '0' . ' грн.',//current_pay
                    Yii::$app->formatter->asDecimal($indication->correction ?: 0, 2) . ' грн.',//perescore
                    date('01.m.Y'),//date_pay
                    Yii::$app->formatter->asDecimal($indication->debt_end_month ?: 0, 2) . ' грн.',//payment
                    Yii::$app->formatter->asDecimal($indication->debt_end_month ?: 0, 2) . ' грн.'//total_payment

                ];
                $template = $_SERVER['DOCUMENT_ROOT'] . "/template/template-history.docx";
            }


            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template);

            $templateProcessor->setValue($search, $replace);

            try {
                $templateProcessor->saveAs($fullName);
            } catch (\Exception $e) {
                return false;
            }

        } else {
            return Yii::$app->session->setFlash('error', 'Не вдалося сформувати документ');
        }

        Yii::$app->response->sendFile($fullName, $name);
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
