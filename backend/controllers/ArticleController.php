<?php

namespace backend\controllers;

use backend\models\AdminLog;
use yii\filters\AccessControl;
use Yii;
use common\models\Article;
use common\models\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => '/news/image/',
                'path' => Yii::getAlias('@webroot/news/image'),
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/news/image/',
                'path' => Yii::getAlias('@webroot/news/image')
            ],
            'image-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => '/news/image/',
                'path' => Yii::getAlias('@webroot/news/image'),
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => '/news/docs/',
                'path' => Yii::getAlias('@webroot/news/docs'),
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'url' => '/news/docs/',
                'path' => Yii::getAlias('@webroot/news/docs'),
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/news/docs/',
                'path' => Yii::getAlias('@webroot/news/docs'),
                'uploadOnlyImage' => false,
            ],
        ];
    }


    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => Article::find(),
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//        ]);

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->backendSearch(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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

    public function actionDelPhoto($id)
    {

        $model = $this->findModel($id);
        $img = Yii::getAlias('@webroot').$model->getImageFileUrl('img');
        $thumb = Yii::getAlias('@webroot').$model->getThumbFileUrl('img', 'thumb');

        if(file_exists( $img)){
            unlink($img);
        }
        if(file_exists( $thumb)){
            unlink($thumb);
        }
        $model->img = '';
        if(!$model->save()){
           Yii::$app->session->setFlash('danger', 'Не удалось удалить изображение');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            AdminLog::addAdminAction( $model->id, "Создание новости $model->title");

            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            AdminLog::addAdminAction( $model->id, "Изменение новости $model->title");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        AdminLog::addAdminAction( $id, "Удаление новости $model->title");
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
