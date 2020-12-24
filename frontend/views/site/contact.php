<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
/* @var $client \common\models\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use common\models\ConfigSite;

$settings = ConfigSite::getSettings(1);
$this->title = 'Контактна iнформацiя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">
    <!--Title-->
    <div class="font-sans">
        <h2 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl"><?= Html::encode($this->title) ?></h2>
        <hr class="border-b border-gray-400">
    </div>
    <!--Post Content-->
    <table>
        <tr class="mt-3">
            <td><span style="background-color:transparent;font-size:12pt"><strong>Наша адреса:</strong></span></td>
            <td><span style="background-color:transparent;font-size:12pt"> <?= $settings->address ?></span></td>
        </tr>
        <tr class="mt-3">
            <td><span style="background-color:transparent;font-size:12pt"><strong>Графiк роботи:</strong></span></td>
            <td>
                <span style="background-color:transparent;font-size:12pt"> <strong>Пн.</strong> 8.00 до 17.00<br/>
                     <strong>Вт.</strong> 8.00 до 17.00<br/>
                     <strong>Ср.</strong> 8.00 до 17.00<br/>
                     <strong>Чт.</strong> 8.00 до 17.00<br/>
                     <strong>Пт.</strong> 8.00 до 16.00<br/>
                     <strong>Сб.</strong> 8.00 до 15.00 (Абонвідділ) (без перерви)<br/>
                     <strong>Нд.</strong> Вихідний день<br/>
                     <strong>Перерва:</strong> 12.00 до 13.00
                </span>
            </td>
        </tr>
        <tr class="mt-3">
            <td><span style="background-color:transparent;font-size:12pt"><strong>Приймальня:</strong></span></td>
            <td><span style="background-color:transparent;font-size:12pt"> <?= $settings->phone_priem ?></span></td>
        </tr>
        <tr class="mt-3">
            <td><span style="background-color:transparent;font-size:12pt"><strong>Диспетчерська:</strong></span></td>
            <td><span style="background-color:transparent;font-size:12pt"> <?= $settings->phone_disp ?></span></td>
        </tr>
    </table>

    <hr class="border-b border-gray-400 mt-4">
</div>

<?php $client = true; if($client): ?>
<div class="min-h-screen flex justify-center bg-gray-50 py-2 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Форма зворотнього зв'язку
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600">
                Якщо у вас є ділові запитання чи інші запитання, заповніть таку форму, щоб зв’язатися з нами. Дякую.
            </p>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'mt-8']); ?>
        <input type="hidden" name="remember" value="true">
        <div class="rounded-md shadow-sm">
            <div>
                <?= $form->field($model, 'name')
                    ->textInput(['type'=>'text', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder'=>'Введіть ваше ім\'я'])
                    ->label('Ім\'я', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
            </div>

            <div>
                <?= $form->field($model, 'email')
                    ->textInput(['type'=>'email', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder'=>'Введіть ваш email'])
                    ->label('Email', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
            </div>

            <div>
                <?= $form->field($model, 'subject')
                    ->textInput(['type'=>'text', 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5', 'placeholder'=>'Тема повідомлення'])
                    ->label('Тема', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
            </div>

            <div>
                <?= $form->field($model, 'body')
                    ->textarea(['rows' => 6, 'class'=>'appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5'])
                    ->label('Повідомлення', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
            </div>

            <div>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])->label('Код перевірки', ['class'=>'block text-grey-darker text-sm font-bold mb-2'])  ?>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" name="contact-button" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                  <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                  </span>
                Отправить
            </button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php endif; ?>

<div class="page-view">
    <h2 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Ми на картi:</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1852.817464986601!2d38.48007791334082!3d48.94816193838916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x412010948aa2b2cb%3A0x8fa5c9476314b22f!2z0JrQnyAi0KHQhNCS0ITQoNCe0JTQntCd0JXQptCs0JrQktCe0JTQntCa0JDQndCQ0Jsi!5e0!3m2!1sru!2sua!4v1601025311447!5m2!1sru!2sua" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
