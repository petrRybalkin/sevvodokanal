<?php
use yii\helpers\Url;

if($number):
?>

    <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
        <a href="<?= Url::to(['/profile/water-metering', 'id'=> $number]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
            <span class="pb-1 md:pb-0 text-sm">Передача показань</span>
        </a>
    </li>
    <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
        <a href="<?= Url::to(['/profile/history', 'id'=> $number]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
            <span class="pb-1 md:pb-0 text-sm">Нарахування та передані показання</span>
        </a>
    </li>
    <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
        <a href="<?= Url::to(['/profile/score', 'id'=> $number]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
            <span class="pb-1 md:pb-0 text-sm">Рахунок</span>
        </a>
    </li>
    <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
        <a href="<?= Url::to(['/profile/payment', 'id'=> $number]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
            <span class="pb-1 md:pb-0 text-sm">Оплата</span>
        </a>
    </li>
    <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
        <a href="<?= Url::to(['/profile/account-number', 'id'=> $number]) ?>" class="block pl-4 align-middle text-gray-700 no-underline hover:text-purple-500 border-l-4 border-transparent lg:hover:border-gray-400">
            <span class="pb-1 md:pb-0 text-sm">Дані особового рахунку</span>
        </a>
    </li>

<?php endif; ?>