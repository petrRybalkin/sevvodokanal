<?php

namespace common\dbfImport;

use backend\models\FilesLog;
use common\models\Company;
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

        foreach ($this->parser() as $item) {
            $arr =  array_combine($this->tableFaild() ,$item);
                $newCompany = new Company();
                $newCompany->setAttributes($arr);
                if (!$newCompany->save()) {
                    $error .= Json::encode($newCompany->getErrors());
                    continue;
                } else {
                    print_r('ok');
                }
        }
        $this->log($admin_id, $error !=='' ? "Запись файла $fileName окончена. Ошибки - ".$error :"Запись файла $fileName окончена." );
        return true;
    }
}
