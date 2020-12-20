<?php

namespace common\dbfImport;

use backend\models\FilesLog;
use common\models\Company;
use common\models\ScoreMetering;
use DateTime;
use Yii;
use yii\helpers\Json;

class CompanyDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'kod_p' => [
                'field' => 'num_contract',
                'type' => static::TYPE_STRING,
                'title' => 'Номер договору',
            ],
            'nomer' => [
                'field' => 'accounting_number',
                'type' => static::TYPE_STRING,
                'title' => 'Номер засобу обліку',
            ],
            'datgosp' => [
                'field' => 'verification_date',
                'type' => static::TYPE_DATE,
                'title' => 'Дата повірки',
            ],
            'pred' => [
                'field' => 'previous_readings',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Попередні показання',
            ],

        ];
    }


    public function tableFaild()
    {
        return [
            'num_contract',
            'accounting_number',
            'verification_date',
            'previous_readings',
        ];
    }

    public function save($admin_id, $fileName)
    {
        $error = '';
        $str = $this->getRecordCount();
        $this->log($admin_id, "Запись начата $str строк. Файл -  $fileName");

        $i = 0;
//        $isDeleted = [];

        while ($item = $this->nextRecord()) {
            try {

                if ($i % 2000 == 0) {
                    sleep(5);
                    $this->log($admin_id, "ok  $i - " . $item['kod_p']);
                }

                $this->checkDbConnection();
                $arr = array_combine($this->tableFaild(), $item);

                $query = Company::find()
                    ->where(['num_contract' => $item['kod_p'], 'accounting_number' => $item['nomer']]);


                if ($query->exists()) {
                    $company = $query->one();
                    $company->updateAttributes($arr);
                } else {
                    $company = new Company();
                    $company->setAttributes($arr);
                }

                if (!$company->save()) {
                    $error .= 'строка - ' . $i . Json::encode($company->getErrors()) . "\n";
                    continue;
                }

                $i++;

            } catch (\yii\db\Exception $e) {
                $i++;
                $this->log($admin_id, $e->getMessage());
                sleep(2);
            }
        }

        $this->log($admin_id,
            $error !== ''
                ? "Запись файла $fileName окончена. Ошибки - " . $error
                : "Запись файла $fileName окончена.");
        return true;
    }
}
