<?php

namespace frontend\controllers;

use common\models\ClientMap;
use common\models\ScoreMetering;
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

                if ($score = ScoreMetering::find()->where(['account_number' => $model->account_number])->one()) {
                    ClientMap::addClientMap(Yii::$app->user->getId(), $score->id);
                }


                \yii\helpers\VarDumper::dump($model, 10, 1);
                exit;
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

        }
        return $this->render('index', [
            'model' => $model
        ]);
    }


}
