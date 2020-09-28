<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * IndicationForm is the model behind the contact form.
 */
class IndicationForm extends Model
{
    public $number;
    public $meter;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'meter'], 'required'],
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
