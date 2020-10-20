<?php
use yii\helpers\Html;
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Увійдіть, щоб розпочати сеанс</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => 'Введіть ваш логiн']) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => 'Введіть ваш пароль']) ?>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Запам\'ятати мене') ?>
                </div>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Увійти', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

<!--        <div class="social-auth-links text-center mb-3">-->
<!--            <p>- OR -</p>-->
<!--            <a href="#" class="btn btn-block btn-primary">-->
<!--                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook-->
<!--            </a>-->
<!--            <a href="#" class="btn btn-block btn-danger">-->
<!--                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+-->
<!--            </a>-->
<!--        </div>-->
        <!-- /.social-auth-links -->

        <!--<p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p>-->
<!--        <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
        </p>-->
    </div>
    <!-- /.login-card-body -->
</div>