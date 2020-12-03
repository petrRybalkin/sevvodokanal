<?php

namespace common\dbfImport;

use backend\models\FilesLog;
use common\models\Company;
use common\models\ScoreMetering;
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
        while ($item = $this->nextRecord()) {
//        foreach ($this->parser() as $item) {

            $companyExist = Company::find()->where(['account_number' => $item['lic_schet']])->one();

            $arr = array_combine($this->tableFaild(), $item);

            if ($companyExist) {
                $companyExist->updateAttributes($arr);
            }

            $newCompany = new Company();
            $newCompany->setAttributes($arr);
            if (!$newCompany->save()) {
                $error .= Json::encode($newCompany->getErrors());
                continue;
            } else {
                $this->log($admin_id, "ok  $i - " . $item['lic_schet']);
//                    print_r('ok');
            }
            $i++;
        }
        $this->log($admin_id, $error !== '' ? "Запись файла $fileName окончена. Ошибки - " . $error : "Запись файла $fileName окончена.");
        return true;
    }
}
