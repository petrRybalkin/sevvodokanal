<?php

namespace common\queue;

use Yii;
use yii\queue\JobInterface;

class DbfJob extends BaseJob implements JobInterface
{

    public $file;
    public $model;

    public function execute($queue)
    {
        $filename = Yii::getAlias('@backend/web/dbfLog.php');
        $handle =  fopen($filename, 'w');
        $this->log($handle, "Началась обработка файла");
        $parser = new $this->model ($this->file);
        if (!$parser->save()) {
            $this->log($handle, "Ошибка сохранения");
        }
        $this->log($handle, "Файл сохранен");
        fclose($handle);
        return '444444';
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