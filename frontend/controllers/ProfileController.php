<?php

namespace frontend\controllers;

use common\models\ClientMap;
use common\models\IndicationsAndCharges;
use common\models\Payment;
use common\models\ScoreMetering;
use common\models\WaterMetering;
use frontend\models\IndicationForm;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        $model = new ScoreMetering();
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
                if (!$indication || strtotime($indication->month_year) < strtotime(Yii::$app->formatter->asDate(('NOW'), 'php:Ym'))) {
                    $indication = new  IndicationsAndCharges();
                }

                if ($model->meter1 && $model->number1) {
                    $wm = WaterMetering::find()->where(['water_metering_first' => $model->number1])->one();
                    $indication->updateAttributes(['current_readings_first' => $model->meter1]);
                    $wm->updateAttributes(['previous_readings_first' => (int)$model->meter1]);
                }
                if ($model->meter2 && $model->number2) {
                    $wm = WaterMetering::find()->where(['water_metering_second' => $model->number2])->one();
                    $indication->updateAttributes(['current_readings_second' => $model->meter2]);
                    $wm->updateAttributes(['previous_readings_second' => (int)$model->meter2]);
                }
                if ($model->number3 && $model->meter3) {
                    $wm = WaterMetering::find()->where(['watering_number' => $model->number3])->one();
                    $indication->updateAttributes(['current_readings_watering' => $model->meter3]);
                    $wm->updateAttributes(['previous_watering_readings' => (int)$model->meter3]);
                }
                $indication->updateAttributes([
                    'account_number' => $wm->account_number,
                    'month_year' => Yii::$app->formatter->asDate(('NOW'), 'php:Ym'),
                    'synchronization' => 1
                ]);
                $wm->updateAttributes(['date_previous_readings' => Yii::$app->formatter->asDate(('NOW'), 'php:Y-m-d')]);
                Yii::$app->session->setFlash('success', 'Показання переданi.');
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
            'indication'=> $indication,
            'metering' => $metering,
            'payment'=> $payment
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

}
