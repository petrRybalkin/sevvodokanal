<?php


namespace common\queue;


use Yii;
use yii\base\BaseObject;
use yii\helpers\Json;

class BaseJob extends BaseObject
{
//    /**
//     * @throws \yii\db\Exception
//     */
//    protected function checkDbConnection()
//    {
//        try {
//            \Yii::$app->db->createCommand("DO 1")->execute();
//        } catch (\yii\db\Exception $e) {
//            \Yii::$app->db->close();
//            \Yii::$app->db->open();
//        }
//    }

    /**
     * @param $message
     */
    protected function log($filename, $message)
    {
        if ($message instanceof \Exception) {
            $message = $message->getMessage();
        }
        if (!is_string($message)) {
            $message = Json::encode($message);
        }
        if (is_a(Yii::$app, 'yii\web\Application')) {
            return;
        }
        $time = new \DateTime();

        fwrite($filename, "{$time->format('Y-m-d H:i:s')}: {$message}\n");
        return 'ok';
//        echo "{$time->format('Y-m-d H:i:s')}: {$message}\n";
    }
}