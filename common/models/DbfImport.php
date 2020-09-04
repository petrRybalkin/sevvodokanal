<?php

namespace common\models;

use Yii;
use yii\base\Model;

class DbfImport extends Model
{
    public $dbfFile;
    public $fileName;

    public function rules()
    {
        return [
            [['dbfFile'], 'file'],

        ];
    }
}
