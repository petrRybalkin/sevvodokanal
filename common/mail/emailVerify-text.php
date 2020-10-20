<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Доброго часу доби <?= $user->username ?>,

Перейдіть за посиланням нижче, щоб підтвердити свою електронну адресу:

<?= $verifyLink ?>
