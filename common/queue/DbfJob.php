<?php

namespace common\queue;

use yii\queue\JobInterface;

class DbfJob extends BaseJob implements JobInterface
{

    public $file;
    public $model;

    public function execute($queue)
    {

        $filename = '@backend/web/dbfLog.txt';
        $handle =  fopen($filename, 'w');
        $this->log($handle, "Началась обработка файла  - ". \Yii::$app->formatter->asDate(('NOW'))
            . "Админ - ". \Yii::$app->user->identity->username);
        $parser = new $this->model ($this->file);

        if($parser->save()){
            return true;
        }else{
            return false;
        }

//        try {
//            $parser->save();
//
//        } catch (\Exception $e) {
//            $this->log($e->getMessage());
//            $this->log($e->getTraceAsString());
//            return false;
//        }
//        $this->log($handle, "Файл сохранен");
//        fclose($handle);
//        return '444444';
    }


    public function getTtr()
    {
        return 15;
    }


    public function canRetry($attempt, $error, $filename)
    {
        if ($error) {
            $this->log($filename, $error);
        }
        return ($attempt < 100);
    }

}