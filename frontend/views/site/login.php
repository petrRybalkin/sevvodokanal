<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div>
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                    <?= Html::encode($this->title) ?>
                </h2>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600">
                    Будь ласка, заповніть наступні поля для входу:
                </p>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'mt-8']); ?>
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm">
                    <div>
                        <?= $form->field($model, 'email')
                            ->textInput(['type'=>'email', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder'=>'Введіть ваш email'])
                            ->label('Email', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
                    </div>
                    <div class="-mt-px">
                        <?= $form->field($model, 'password')->passwordInput(['class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder'=>'Введіть ваш пароль'])
                            ->label('Пароль',['class'=>'block text-grey-darker text-sm font-bold mb-2 mt-3'])  ?>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <?= $form->field($model, 'rememberMe')
                            ->checkbox(['class'=>'form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out'])
                            ->label('Запам\'ятати мене', ['class'=>'ml-2 block text-sm leading-5 text-gray-900']) ?>
                    </div>

                    <div class="text-sm leading-5">
                        <?= Html::a('Забули свій пароль?', ['site/request-password-reset'], ['class' => 'font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150']) ?>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                      <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                      </span>Увійти
                    </button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
