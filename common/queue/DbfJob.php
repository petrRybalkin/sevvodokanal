<?php

namespace common\queue;

use Yii;
use yii\queue\JobInterface;
use yii\queue\RetryableJobInterface;

class DbfJob extends BaseJob implements JobInterface
{

    public $file;
    public $model;
    public $admin_id;
    public $fileName;

    public function execute($queue)
    {
        $parser = new $this->model ($this->file);

        if($parser->save($this->admin_id,$this->fileName)){
            return true;
        } else {
            return false;
        }
    }

    public function dbConnect()
    {
        return $this->checkDbConnection();
    }

    public function getTtr()
    {
        return 15 * 60;
    }


    public function canRetry($attempt, $error, $filename)
    {
        if ($error) {
            $this->log($filename, $error);
        }
        return ($attempt < 100);
    }

}