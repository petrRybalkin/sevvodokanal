<?php

namespace frontend\controllers;

use common\models\Company;
use common\models\LegalForm;
use common\models\LegalNumContractForm;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class LegalController extends Controller
{

    public function actions()
    {
        return [
            // ...
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new LegalNumContractForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->validate()) {
//                if(Yii::$app->request->post('num_button')){
            return $this->redirect(['/legal/numbers', 'num' => $model->num_contract]);
//                }
//            }
//            else {
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($model);
//            }
        }
        return $this->render('index', [
            'model' => $model
        ]);
    }


    public function actionNumbers($num)
    {
        $model = Company::find()->where(['num_contract' => $num])
            ->all();
        return $this->render('numbers', [
            'model' => $model,
            'num' => $num
        ]);
    }

    public function actionMeter($num, $acc)
    {
        $company = Company::find()->where([
            'num_contract' => $num,
            'accounting_number' => $acc])
            ->one();

        $model = new LegalForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $company = Company::find()
                ->where(['num_contract' => $model->num_contract, 'accounting_number' => $model->acc_num])
                ->one();
            /** @var Company $company */
            $company->current_readings = $model->current_readings;

            $company->date_readings = date('Y-m-d');
            $company->sinh = 1;
            if($company->save()){
                Yii::$app->session->setFlash('success', 'Показання успiшно переданi.');
            }

//                дата наступної повірки” - “поточна дата”) < (“один місяць”)

            $datetime1 = date_create($company->verification_date);
            $datetime2 = date_create(date('Y-m-d'));
            $interval = date_diff($datetime1, $datetime2);

            if ($interval->days / 30 < 1) {
                Yii::$app->session->setFlash('error', 'Наближаеться дати повірки  засобу обліку води, рекомендуемо звернутись до відділу збуту підприємства.');
            }

            return $this->redirect(['legal/numbers', 'num' => $num]);
        }

        return $this->render('meter', [
            'company' => $company,
            'model' => $model,
            'num' => $num
        ]);
    }

    /**
     * @return array
     */
    public function actionFormNumContract()
    {
        $model = new LegalForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->validate()) {
                $comp = Company::find()->where(['num_contract' => $model->num_contract])->all();
                return ['success' => 1,
                    'company' => $comp
                ];
            } else {
                return \yii\widgets\ActiveForm::validate($model);
            }

        }
    }


}