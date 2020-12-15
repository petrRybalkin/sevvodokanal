<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;

class PbController extends Controller
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
     * Lists all Page models.
     * @return mixed
     */
    public function actionPbch()
    {
        $this->layout = false;
        return $this->render('pbch');
    }


}
