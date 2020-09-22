<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DbfImport extends Model
{
    public $dbfFile;
    public $fileName;
    public $code;

    const WIN = 1;
    const UTF = 2;
    const DOS = 3;

    public function rules()
    {
        return [
            [['dbfFile'], 'file'],
            [['code'], 'integer'],
        ];
    }

    public static function codeList()
    {
        return [
            self::WIN => 'Windows-1251',
            self::UTF => 'UTF-8',
            self::DOS => 'CP850',
        ];
    }

    public static function getCodeLabel($code, $default = '-')
    {
        return ArrayHelper::getValue(self::codeList(), $code, $default);
    }
}