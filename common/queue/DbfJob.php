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
//        $filename = Yii::getAlias('@backend/web/dbfLog.php');
//        $handle =  fopen($filename, 'w');
//        $this->log($handle, "Началась обработка файла  - ". \Yii::$app->formatter->asDate(('NOW'))
//            . "Админ - ". \Yii::$app->user->identity->username);
        $parser = new $this->model ($this->file);

        if($parser->save()){
            return true;
        }else{
            return false;
        }
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