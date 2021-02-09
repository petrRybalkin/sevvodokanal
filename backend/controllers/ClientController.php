<?php

namespace backend\controllers;

use backend\models\AdminLog;
use common\models\ClientMap;
use common\models\ScoreMetering;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionScore($id)
    {
        $clientScore = ClientMap::find()->select('score_id')->where(['client_id' => $id])->column();

        $model = new ActiveDataProvider([
            'query' => ScoreMetering::find()->where(['id' => $clientScore]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('score', [
            'model' => $model


        ]);
    }

    /**
     * @param $id
     * @param $score_id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteNumber($id,$score_id)
    {
        $n = ClientMap::find()->where(['client_id' => $id, 'score_id' => $score_id])->one();
        /** @var User $client */
        $client = $n->client;
        if (!$n->delete()) {
            Yii::$app->session->setFlash('error', 'Не вдалося видалити рахунок.');
        } else {
            $message = "Рахунок {$score_id} видалено. Абонент №{$id}";
            if ($client) {
                $message .= " ({$client->email})";
            }
            AdminLog::addAdminAction(null, $message);
            Yii::$app->session->setFlash('success', 'Рахунок видалено.');
        }
        return $this->redirect(['score', 'id' => $id]);
    }

    /**
     * Displays a single Client model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            AdminLog::addAdminAction(null, "Добавление абонента $model->username");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            AdminLog::addAdminAction(null, "Редактирование абонента $model->username");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        ClientMap::deleteAll(['client_id' => $id]);

        AdminLog::addAdminAction(null, "Удаление абонента $model->username");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
