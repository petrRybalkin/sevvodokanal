<?php

namespace backend\controllers;

use common\dbfImport\CompanyDBF;
use common\dbfImport\IndicationsAndChargesDBF;
use common\dbfImport\InfoDBF;
use common\dbfImport\PaymentDBF;
use common\dbfImport\ScoreDBF;
use common\models\DbfImport;
use common\queue\DbfJob;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;

class DbfImportController extends Controller
{
    public function actionIndex($model = null)
    {
        if (!empty($model)) {
            $fileName = $model->fileName;
            $path = Yii::getAlias('@backend/web/' . $fileName);
            $parser = new InfoDBF($path);
            $dataArray = $parser->parser(5);
            $total = $parser->getRecordCount();
        } else {
            $total = 0;
            $dataArray = [];
        }

        if (empty($model)) {
            $model = new DbfImport();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataArray,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'lic_schet', 'regn', 'nh1', 'nh2', 'np', 'ph1', 'ph2', 'pp', 'dppp',
                    'namh1', 'namh2', 'namp', 'datgos', 'srkub', 'khvsrn'
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'total' => $total,
            'model' => $model
        ]);
    }


    public function actionScore($model = null)
    {
        if (!empty($model)) {
            $fileName = $model->fileName;
            $path = Yii::getAlias('@backend/web/' . $fileName);
            $parser = new ScoreDBF($path, $model->code);
            $dataArray = $parser->parser(5);
            $total = $parser->getRecordCount();
        } else {
            $total = 0;
            $dataArray = [];
        }

        if (empty($model)) {
            $model = new DbfImport();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataArray,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'lic_schet', 'regn', 'fp', 'adres', 'norma', 'type', 'kol', 'tarif', 'tarifst',
                    'sumtarif'
                ],
            ],
        ]);

        return $this->render('score', [
            'dataProvider' => $dataProvider,
            'total' => $total,
            'model' => $model
        ]);
    }
    public function actionPayment($model = null)
    {
        if (!empty($model)) {
            $fileName = $model->fileName;
            $path = Yii::getAlias('@backend/web/' . $fileName);
            $parser = new PaymentDBF($path, $model->code);
            $dataArray = $parser->parser(5);
            $total = $parser->getRecordCount();
        } else {
            $total = 0;
            $dataArray = [];
        }

        if (empty($model)) {
            $model = new DbfImport();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataArray,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'lic_schet', 'summa', 'datp', 'pr'
                ],
            ],
        ]);

        return $this->render('payment', [
            'dataProvider' => $dataProvider,
            'total' => $total,
            'model' => $model
        ]);
    }

    public function actionCompany($model = null)
    {
        if (!empty($model)) {
            $fileName = $model->fileName;
            $path = Yii::getAlias('@backend/web/' . $fileName);
            $parser = new CompanyDBF($path, $model->code);
            $dataArray = $parser->parser(5);
            $total = $parser->getRecordCount();
        } else {
            $total = 0;
            $dataArray = [];
        }

        if (empty($model)) {
            $model = new DbfImport();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataArray,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'lic_schet', 'regn', 'fp', 'adres', 'norma', 'type', 'kol', 'tarif', 'tarifst',
                    'sumtarif'
                ],
            ],
        ]);

        return $this->render('company', [
            'dataProvider' => $dataProvider,
            'total' => $total,
            'model' => $model
        ]);
    }

    public function actionIndications($model = null)
    {
        if (!empty($model)) {
            $fileName = $model->fileName;
            $path = Yii::getAlias('@backend/web/' . $fileName);
            $parser = new IndicationsAndChargesDBF($path, $model->code);
            $dataArray = $parser->parser(5);
            $total = $parser->getRecordCount();
        } else {
            $total = 0;
            $dataArray = [];
        }

        if (empty($model)) {
            $model = new DbfImport();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataArray,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'lic_schet', 'mes', 'lgo', 'kol','hsal',
                ],
            ],
        ]);

        return $this->render('indications', [
            'dataProvider' => $dataProvider,
            'total' => $total,
            'model' => $model
        ]);
    }

    public function actionUpload()
    {
        $model = new DbfImport();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->dbfFile = UploadedFile::getInstance($model, 'dbfFile');

            if ($model->dbfFile && $model->validate()) {
                $model->fileName = 'uploads/file' . date('Y-m-dH:i:s') . '.' . $model->dbfFile->extension;
                $model->dbfFile->saveAs($model->fileName);
            }
        }

        return $this->runAction(Yii::$app->request->post('action'), [
            'model' => $model
        ]);
    }

    public function actionSave($fileName, $class, $action)
    {

        $path = Yii::getAlias('@backend/web/' . $fileName);
        $modelName = 'common\dbfImport\\' . $class;
//        $parser = new $modelName($path);
//        $parser->save();
    $idJob =  \Yii::$app->queue->push(new DbfJob([
            'file' => $path,
            'model'=> $modelName

        ]));


        $startTime = time();
        while(!Yii::$app->queue->isDone($idJob)){
            sleep(1);
            if (time() - $startTime > 30) {
                  Yii::$app->session->setFlash('danger', 'Не удалось сохранить данные');
                return $this->redirect($action);
            }
        }

        Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
        return $this->redirect($action);


    }
}
