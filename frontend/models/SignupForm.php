<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\bootstrap\ActiveForm;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $password_confirm;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            //['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Цей псевдонім вже зайнятий.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Цей емейл вже зайнятий.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 10],

            ['password_confirm', 'compare','compareAttribute' => 'password'],

            ['phone', 'required'],
            ['phone', 'string', 'min' => 12],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Цей телефон вже зайнятий.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email'     => 'Email',
            'password'  => 'Пароль',
            'password_confirm'  => 'Пiдтвердження пароля',
            'phone'     => 'Телефон',
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
            return false;
            }

            $client = new User();
            $client->username = $this->username;
            $client->email = $this->email;
            $client->phone = $this->phone;
            $client->setPassword($this->password);
            $client->generateAuthKey();
            $client->generateEmailVerificationToken();

        return $client->save() && $this->sendEmail($client);

    }

    /**
     * Sends confirmation email to user
     * @param User $client user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($client)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $client]
            )
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($this->email)
            ->setSubject('Реєстрація аккаунту ' . Yii::$app->params['senderName'])
            ->send();
    }
}
