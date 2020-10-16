<?php

namespace frontend\controllers;

use common\models\ClientMap;
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
                if (ClientMap::find()->where(['client_id' => Yii::$app->user->getId()])->count() == 5) {
                    Yii::$app->session->setFlash('danger', 'Можна додати не бiльш 5 особових рахункiв.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
                $score = ScoreMetering::find()->where(['account_number' => $model->account_number]);
                if ($model->act_number) {
                    $score->andWhere(['act_number' => $model->act_number]);
                } else {
                    $model->addError('act_number', 'Заполните поле');
                }
                if ($model->sum) {
                    $sum = Payment::find()->where(['account_number' => $model->account_number])->one();
                    if (str_replace(',', '.', $model->sum) + 0 !== $sum->sum) {
                        Yii::$app->session->setFlash('success', 'Невірна сума оплати - можливо, Ви помилились при вводі суми оплати.');
                    }
                } else {
                    $model->addError('sum', 'Заполните поле');
                }
                if ($score = $score->one()) {
                    ClientMap::addClientMap(Yii::$app->user->getId(), $score->id);
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


    public function actionAccountNumber($id)
    {
        $number = ScoreMetering::find()->where(['id' => $id])->one();
        return $this->render('account-number', [
            'number' => $number
        ]);

    }

    public function actionWaterMetering($id)
    {
        $number = ScoreMetering::find()->where(['id' => $id])->one();


        return $this->render('water-metering', [
            'number' => $number,

        ]);

    }


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
                $wc = ((int)$model->meter1 -(int)$indication->previous_readings_first)
                    + ((int)$model->meter2-(int)$indication->previous_readings_second );
                $watc = (int)$model->meter3 - (int)$indication->previous_readings_watering ;
                $indication->updateAttributes([
                    'account_number' => $wm->account_number,
                    'month_year' => Yii::$app->formatter->asDate(('NOW'), 'php:Ym'),
                    'synchronization' => 1,
                    'water_consumption' =>$wc ,
                    'watering_consumption' =>$watc,
                    'accruals' => ($wc + $watc) *$indication->total_tariff
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

    public function actionPayment($id)
    {
        return $this->render('payment', [
        ]);

    }

    public function actionHistory($id)
    {
        $score = ScoreMetering::find()->where(['id' => $id])->one();
        $metering = WaterMetering::find()->where(['account_number' => $score->account_number])->all();
        $indication = IndicationsAndCharges::find()->where(['account_number' => $score->account_number])->all();


        return $this->render('history', [
            'metering' => $metering,
            'score' => $score,
            'indication' => $indication,

        ]);

    }


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
                    'norm',
                    $score->total_tariff,
                    $indication->current_readings_first + $indication->current_readings_second - $indication->previous_readings_first - $indication->previous_readings_second,
                    $indication->current_readings_watering - $indication->previous_readings_watering,
                    Yii::$app->formatter->asDate($metering->verification_date, 'php:d.m.Y'),
                    $indication->privilege == 0 ? 'Нi' : "Так",
                    Yii::$app->formatter->asDate(('NOW'), 'php: d.m.Y'),
                    $indication->debt_end_month,
                    $indication->accruals,
                    $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2),
                    Payment::getLgota($score->account_number, 3) ?: '-',
                    Payment::getLgota($score->account_number, 1) ? Payment::getLgota($score->account_number, 1)->sum : '0' ,
                    'perescore',
                    Yii::$app->formatter->asDate(('NOW'), 'php: d.m.Y'),
                    $indication->accruals -
                    $indication->privilege_unpaid !== 0 ? $indication->privilege_unpaid : Payment::getLgota($score->account_number, 2) -
                        Payment::getLgota($score->account_number, 3),
                    'total_payment'

                ],
            ]));
        }
        $startTime = time();
        while (!Yii::$app->queue->isDone($id)) {
            sleep(1);
            if (time() - $startTime > 30) {
                return Yii::$app->session->setFlash('danger', 'Не вдалося сформувати документ');
            }
        }
        Yii::$app->response->sendFile($fullName);
        return Yii::$app->response->send();
    }
}
