<?php

namespace common\queue;

use backend\models\FilesLog;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\queue\RetryableJobInterface;

class PhpWordJob extends BaseJob implements RetryableJobInterface
{
    public $template;
    public $path;
    public $search;
    public $replace;

    public function execute($queue)
    {
        $this->log(1,"Run PhpWordJob");
        $this->log(1,$this->template);
        $this->log(1,$this->path);

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($this->template);

        $templateProcessor->setValue($this->search, $this->replace);
//        print_r($this->path);exit;
        $this->log(1,"Replaced");

        try {
//            print_r($this->path);exit;
            $templateProcessor->saveAs($this->path);
            $this->log(1,"save");
        } catch (\Exception $e) {
            $this->log(1,$e->getMessage());
            return false;
//            $this->log($e->getMessage());
//            $this->log($e->getTraceAsString());
        }

//        $this->log("--------------------\n");
    }

    public function getTtr()
    {
        return 15;
    }

    public function canRetry($attempt, $error)
    {
        if ($error) {
            print_r($error);exit;
//            $this->log($error);
        }
        return ($attempt < 100);
    }

    public function log($admin_id,  $message){

        $adminLog = new FilesLog();
        $adminLog->message = $message ;
        $adminLog->admin_id = $admin_id;
        $adminLog->created_at = date('Y-m-d H:i:s');

        $adminLog->save(false);
        return true;
    }
}