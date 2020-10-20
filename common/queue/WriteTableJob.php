<?php

namespace common\queue;

use common\models\IndicationsAndCharges;
use XBase\WritableTable;
use Yii;
use yii\queue\JobInterface;

class WriteTableJob extends BaseJob implements JobInterface
{

    public $file;

    public function execute($queue)
    {
        $model = IndicationsAndCharges::find()
            ->where(['synchronization' => 1]);
        print_r('kk');

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

        if (!dbase_create($this->file, $def)) {
            return false;
            Yii::$app->session->setFlash('danger', "Ошибка, не получается создать базу данных\n") ;
        }

        print_r("ok1\n");
        $table = new WritableTable($this->file);
        $table->openWrite();
        foreach ($model->each() as $item) {
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