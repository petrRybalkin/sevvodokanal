<?php

namespace common\dbfImport;

use backend\models\FilesLog;
use common\models\DbfImport;
use XBase\Table;

abstract class BaseDBF
{
    const TYPE_NUMERIC = 1;
    const TYPE_DATE = 2;
    const TYPE_STRING = 3;
    const TYPE_FLOAT = 4;

    public $table;
    public $dbfFile;

    public function __construct($path, $code = 'windows-1251')
    {
        $this->table = new Table($path, null, DbfImport::getCodeLabel($code,'windows-1251'));
//        $this->table = new Table($path, null, 'windows-1251');
    }

    public function nextRecord(){
        $record = $this->table->nextRecord();

        if (!$record) {return false;}
        $columns = array_keys($this->table->columns);

        foreach ($this->fieldList() as $column => $settings) {

            if ($settings['type'] == self::TYPE_DATE) {
                $item[$column] = date('Y-m-d', strtotime($record->$column));
            } else {
                if($column === 'synch'){
                    $item[$column] = 1;
                }else{
                    if (in_array($column, $columns)) {
                        $item[$column] = $record->$column;
                    } else {
                        $item[$column] = null;
                    }
                }

            }

        }
        return $item;
    }

    public function parser($limit = 0, $str = 0)
    {
        $retTable = [];
        $item = [];
        $i = 0;
        $columns = array_keys($this->table->columns);

        while ($record = $this->table->nextRecord()) {
            if ($limit !== 0 && $i >= $limit) {
                return $retTable;
            }

            foreach ($this->fieldList() as $column => $settings) {

                if ($settings['type'] == self::TYPE_DATE) {
                    $item[$column] = date('Y-m-d', strtotime($record->$column));
                } else {
                    if($column === 'synch'){
                        $item[$column] = 1;
                    }else{
                        if (in_array($column, $columns)) {
                            $item[$column] = $record->$column;
                        } else {
                            $item[$column] = null;
                        }
                    }

                }

            }
            $retTable[] = $item;
            $i++;
        }
        return $retTable;
    }

    public function getRecordCount()
    {
        return $this->table->getRecordCount();
    }

    abstract public function fieldList();

    abstract public function save($admin_id, $fileName);

     public function log($admin_id,  $message){

         $adminLog = new FilesLog();
         $adminLog->message = $message ;
         $adminLog->admin_id = $admin_id;
         $adminLog->created_at = date('Y-m-d H:i:s');

         $adminLog->save(false);
         return true;
     }


}
