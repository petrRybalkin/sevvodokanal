<?php

namespace common\queue;

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
//        $this->log("Run PhpWordJob");

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($this->template);

        $templateProcessor->setValue($this->search, $this->replace);
//        print_r($this->path);exit;
//        $this->log("Replaced");

        try {
//            print_r($this->path);exit;
            $templateProcessor->saveAs($this->path);

        } catch (\Exception $e) {

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
}