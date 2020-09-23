<?php

namespace common\dbfImport;

use common\models\Company;
use Yii;

class CompanyDBF extends BaseDBF
{
    public function fieldList()
    {
        return [
            'kod_p' => [
                'field' => 'num_contract',
                'type' => static::TYPE_NUMERIC,
                'title' => 'Номер договору',
            ],
            'nomer' => [
                'field' => 'accounting_number',
                'type' => static::TYPE_NUMERIC,
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

    public function save()
    {

        foreach ($this->parser() as $item) {
            $company = Company::find()->where(['num_contract' => $item['kod_p']])->one();

            $arr =  array_combine($this->tableFaild() ,$item);
            if($company){
                $company->updateAttributes($arr);
            }else{
                $newCompany = new Company();
                $newCompany->setAttributes($arr);
                $newCompany->save();
            }
        }

    }
}
