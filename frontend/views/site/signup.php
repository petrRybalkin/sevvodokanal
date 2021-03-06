<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Реєстрація';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="min-h-screen flex justify-center bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                <?= Html::encode($this->title) ?>
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600">
                Будь ласка, заповніть наступні поля для реєстрації:
            </p>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'class' => 'mt-8',
            'enableAjaxValidation' => true,
        ]); ?>
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm">
            <div>
                <?= $form->field($model, 'username')->textInput()->hiddenInput(['autofocus' => true, 'value' => 'Абонент№' . date('d-m-Y H:i:s')])->label('') ?>
            </div>

            <div>
                <?= $form->field($model, 'email')
                    ->textInput(['type' => 'email', 'tabindex'=>'-1', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder' => 'Введіть ваш email'])
                    ->label('Email', ['class' => 'block text-grey-darker text-sm font-bold mb-2']) ?>
            </div>

            <div>
                <?= $form->field($model, 'phone')
                    ->textInput(['type' => 'phone', 'tabindex'=>'-1', 'class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder' => 'Ваш телефон'])
                    ->label('Телефон', ['class' => 'block text-grey-darker text-sm font-bold mb-2 mt-3']) ?>
            </div>

            <div>
                <?= $form->field($model, 'password')->passwordInput(['tabindex'=>'-1','class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder' => 'Введіть ваш пароль'])
                    ->label('Пароль', ['class' => 'block text-grey-darker text-sm font-bold mb-2 mt-3']) ?>
                <p class="text-grey text-xs mt-1">Принаймні 10 символів</p>
            </div>
            <div>
                <?= $form->field($model, 'password_confirm')->passwordInput(['class' => 'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder' => 'Введіть ваш пароль ще раз'])
                    ->label('Пiдтвердження пароля', ['tabindex'=>'-1','class' => 'block text-grey-darker text-sm font-bold mb-2 mt-3']) ?>
<!--                <p class="text-grey text-xs mt-1">Введiть пароль ще раз</p>-->
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" name="signup-button" value="1" tabindex="-1"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                  <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition ease-in-out duration-150"
                         fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"/>
                    </svg>
                  </span>
                Зареєструватися
            </button>
        </div>
        <p class="text-center my-4">
            <?= Html::a('У мене вже є обліковий запис', ['/site/login'], ['tabindex'=>'-1','class' => 'text-grey-dark text-sm no-underline hover:text-grey-darker']) ?>
        </p>
        <!--        </form>-->
        <?php ActiveForm::end(); ?>
    </div>
</div>


