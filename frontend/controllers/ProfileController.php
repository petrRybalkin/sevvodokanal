<?php

namespace frontend\controllers;

use common\models\ClientMap;
use common\models\Payment;
use common\models\ScoreMetering;
use common\models\WaterMetering;
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
                $score = ScoreMetering::find()->where(['account_number' => $model->account_number]);
                if($model->act_number){
                    $score->andWhere(['act_number' => $model->act_number]);
                }else{
                    $model->addError('act_number','Заполните поле');
                }
                if ($model->sum) {
                    $sum = Payment::find()->where(['account_number' => $model->account_number])->one();
                    if(str_replace(',', '.',$model->sum)+0 !== $sum->sum){
                        Yii::$app->session->setFlash('success', 'Невірна сума оплати - можливо, Ви помилились при вводі суми оплати.');
                    }
                }else{
                    $model->addError('sum','Заполните поле');
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

//        \yii\helpers\VarDumper::dump($score->clientScore,10,1);exit;

        return $this->render('index', [
            'model' => $model,
            'clientScore' => ScoreMetering::find()->where(['id'=> $clientScore])->all()
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
            'number' => $number
    ]);

    }
    public function actionScore($id)
    {
        return $this->render('score', [
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
        return $this->render('history', [
            'metering' => $metering,
            'score'=> $score
    ]);

    }

}
