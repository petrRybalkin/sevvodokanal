<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Доброго часу доби <?= $user->username ?>,

Перейдіть за посиланням нижче, щоб скинути пароль:

<?= $resetLink ?>
