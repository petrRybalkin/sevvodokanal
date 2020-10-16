<?php

namespace backend\models;

use common\models\Admin;
use common\models\User;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "admin_log".
 *
 * @property int $id
 * @property int|null $admin_id
 * @property int|null $action
 * @property string|null $created_at
 * @property string|null $message
 *
 * @property User $admin
 */
class AdminLog extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'action'], 'integer'],
            [['created_at'], 'default', 'value' => new Expression('NOW()') ],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['admin_id'], 'default', 'value' => Yii::$app->user->getId()],
            [['message'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Админ',
            'action' => 'Action',
            'created_at' => 'Дата',
            'message' => 'Действие'
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }


    public static function addAdminAction( $action_id, $message)
    {
        $adminLog = new AdminLog();
        $adminLog->setAttributes([
            'action' => $action_id,
            'message' => $message
        ]);
        $adminLog->save();
        return true;
    }
}
