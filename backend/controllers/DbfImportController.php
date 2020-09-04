<?php

namespace backend\controllers;

use common\dbfImport\InfoDBF;
use common\models\DbfImport;
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

    public function actionUpload()
    {
        $model = new DbfImport();

        if (Yii::$app->request->isPost) {
            $model->dbfFile = UploadedFile::getInstance($model, 'dbfFile');

            if ($model->dbfFile && $model->validate()) {
                $model->fileName = 'uploads/file' . date('Y-m-dH:i:s') . '.' . $model->dbfFile->extension;
                $model->dbfFile->saveAs($model->fileName);
            }
        }

        return $this->runAction('index', [
            'model' => $model
        ]);
    }

    public function actionSave($fileName)
    {
        $path = Yii::getAlias('@backend/web/' . $fileName);
        $parser = new InfoDBF($path);
        $parser->save();

        return 'Данные отправлены';
    }
}
