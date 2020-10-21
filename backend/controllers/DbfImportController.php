<?php

namespace backend\controllers;

use backend\models\AdminLog;
use common\dbfImport\CompanyDBF;
use common\dbfImport\IndicationsAndChargesDBF;
use common\dbfImport\InfoDBF;
use common\dbfImport\PaymentDBF;
use common\dbfImport\ScoreDBF;
use common\models\DbfImport;
use common\models\IndicationsAndCharges;
use common\queue\DbfJob;
use common\queue\WriteTableJob;
use XBase\WritableTable;
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
            AdminLog::addAdminAction( null, "Загрузка файла Показания водомеров");
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
            AdminLog::addAdminAction( null, "Загрузка файла Счета");
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
            AdminLog::addAdminAction( null, "Загрузка файла Оплата");
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
            AdminLog::addAdminAction( null, "Загрузка файла Компании");
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
            AdminLog::addAdminAction( null, "Загрузка файла Нарахування и показання");
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

    public function actionDownload()
    {
        $path = Yii::getAlias('@runtimeBack/Показання_'.date('Y-m-dH:i:s') .'.dbf');

        $model = IndicationsAndCharges::find()
            ->where(['synchronization' => 1]);

        if(!$model){
            Yii::$app->session->setFlash('danger', "Ошибка, не получается создать базу данных\n") ;
            return $this->redirect(Yii::$app->request->referrer);
        }
        $def = [
            ['lic_schet', "C", 13],
            ['regn', "N", 5, 0],
            ['fp', "C", 20],
            ['nh1', "C", 10, 0],
            ['nh2', "C", 10, 2],
            ['np', "C", 10, 0],
            ['th1', "N", 6, 0],
            ['th2', "N", 6, 0],
            ['tp', "N", 6, 0],
            ['ph1', "N", 6, 0],
            ['ph2', "N", 6, 0],
            ['pp', "N", 6, 0],
            ['dpp', "D", 8],

        ];

        if (!dbase_create($path, $def)) {
            Yii::$app->session->setFlash('danger', "Ошибка, не получается создать базу данных\n") ;
        }

        $table = new WritableTable($path);
        $table->openWrite();

        foreach ($model->each(1000) as $item) {
            set_time_limit(500);
            $record = $table->appendRecord();
            $record->lic_schet = $item->account_number;
            $record->regn = $item->score ? $item->score->act_number : 0;
            $record->fp = $item->score ? $item->score->name_of_the_tenant : '';
            $record->nh1 = $item->water ? $item->water->water_metering_first : 0;
            $record->nh2 = $item->water ? $item->water->water_metering_second : 0;
            $record->np = $item->water ? $item->water->watering_number : 0;
            $record->th1 = $item->current_readings_first;
            $record->th2 = $item->current_readings_second;
            $record->tp = $item->previous_readings_watering;
            $record->ph1 = $item->previous_readings_first;
            $record->ph2 = $item->previous_readings_second;
            $record->pp = $item->previous_readings_watering;
            $record->dpp = $item->month_year;
            $table->writeRecord();
            $item->updateAttributes(['synchronization' => 0]);
        }
        $table->close();

        AdminLog::addAdminAction( null, "Скачивание  файла  Показання.dbf");
        if (file_exists($path)) {
            return  \Yii::$app->response->sendFile($path);
        }


        Yii::$app->session->setFlash('danger', "Ошибка, не получается создать базу данных\n") ;
    }

    /**
     * @param $fileName
     * @param $class
     * @param $action
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionSave($fileName, $class, $action)
    {

        $path = Yii::getAlias('@backend/web/' . $fileName);
        $modelName = 'common\dbfImport\\' . $class;

        switch ($class) {
            case 'CompanyDBF':
                $file = 'Компании';
                break;
            case 'InfoDBF':
                $file = 'Показания водомеров';
                break;
            case 'IndicationsAndChargesDBF':
                $file = 'Нарахувань та показань';
                break;
            case 'PaymentDBF':
                $file = 'Оплати';
                break;
            case 'ScoreDBF':
                $file = 'Счета';
                break;
            default:
                $file = $fileName;
                break;
        }

        $idJob = \Yii::$app->queue->push(new DbfJob([
            'file' => $path,
            'model' => $modelName,
            'admin_id' => Yii::$app->user->getId(),
            'fileName' => $file

        ]));



        AdminLog::addAdminAction( null, "Запуск записи в БД  файла  $file");
//        $startTime = time();
//        while (!Yii::$app->queue->isDone($idJob)) {
//            sleep(1);
//            if (time() - $startTime > 100) {
//                Yii::$app->session->setFlash('danger', 'Не удалось сохранить данные');
//                return $this->redirect($action);
//            }
//        }
        Yii::$app->session->setFlash('success', 'Началась загрузка файла. Файл будет загружен через несколько минут.');
        return $this->redirect($action);


    }


    public function actionDel($table)
    {

        Yii::$app->db->createCommand()->truncateTable($table)->execute();
        AdminLog::addAdminAction( null, "Очистка БД $table");
        \yii\helpers\VarDumper::dump(555,10,1);exit;

    }

}
