<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Admin;

/**
 * Signup form
 */
class SignupAdminForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;
    public $role_id;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

//    const ROLE_ADMIN = 20;
//    const ROLE_USER = 10;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Admin', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 12],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['role_id', 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role_id = $this->role_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

//        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param Admin $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom(Yii::$app->params['senderEmail'] )
            ->setTo($this->email)
            ->setSubject('Регистраця администратора ' . Yii::$app->params['senderName'])
            ->send();
    }
}
