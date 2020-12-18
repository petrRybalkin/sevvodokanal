<?php

namespace common\dbfImport;

use yii\helpers\Json;

class LegalEntitiesWaterInfoDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'kod_p' => [
                'field' => 'contract_number',
                'type' => static::TYPE_STRING,
                'title' => 'Номер договору',
            ],
            'nomer' => [
                'field' => 'number',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер засобу обліку',
            ],
            'datgosp' => [
                'field' => 'verification_date',
                'type' => static::TYPE_STRING,
                'title' => 'Дата повірки',
            ],
            'pred' => [
                'field' => 'previous_readings',
                'type' => static::TYPE_STRING,
                'title' => 'Попередні показання',
            ],
        ];
    }

    public function tableField()
    {
        return [
            'contract_number',
            'number',
            'verification_date',
            'previous_readings',
        ];
    }

    public function save($admin_id, $fileName)
    {

        $error = '';
        $str = $this->getRecordCount();
        $this->log($admin_id, "Запись начата $str строк. Файл - $fileName");

        $i = 0;

        while ($item = $this->nextRecord()) {
            try {

                if($i % 2000 == 0){
                    sleep(5);
                    $this->log($admin_id, "ok  $i - " . $item['lic_schet']);
                }

                $this->checkDbConnection();
                $arr = array_combine($this->tableFaild(), $item);

                $query = ScoreMetering::find()->where(['account_number' => $item['lic_schet']]);

                if ($query->exists()) {
                    $score = $query->one();
                    $score->updateAttributes($arr);
                }else{
                    $score = new ScoreMetering();
                    $score->setAttributes($arr);
                }

                if (!$score->save()) {
                    $error .= 'строка - ' . $i . Json::encode($score->getErrors()) . "\n";
                    continue;
                }

                $i++;

            } catch (\yii\db\Exception $e) {
                $i++;
                $this->log($admin_id, $e->getMessage());
                sleep(2);
            }
        }

        $this->log($admin_id, ($error !== ''
            ? "Запись файла $fileName окончена. Ошибки - " . $error
            : "Запись файла $fileName окончена."));
        return true;
    }


}
