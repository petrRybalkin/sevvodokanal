<?php

namespace common\queue;

use XBase\WritableTable;
use Yii;
use yii\queue\JobInterface;

class WriteTableJob extends BaseJob implements JobInterface
{

    public $file;
    public $model;

    public function execute($queue)
    {
        $table = new WritableTable($this->file);
        $table->openWrite();
        foreach ($this->model->each() as $item) {

            $record = $table->appendRecord();
            if(!$item){
                continue;
            }
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
        return true;
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