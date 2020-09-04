<?php
use yii\helpers\Url;
use yii\helpers\Html;

$url = $_SERVER['REQUEST_URI'];
$url_menus = explode("/", $url);
?>

<?php if (isset($mainNew)): ?>

    <div class="font-sans">
        <h2 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Новини</h2>
        <hr class="border-b border-gray-400">
    </div>
    <!--Post Content-->
    <!--Lead Para-->
    <?php if (isset($news)): ?>
        <?php foreach ($news as $new): ?>
            <div>
                <h6 class="font-sans break-normal font-semibold text-black pt-6 text-lg"><?= $new->title ?></h6>
                <p class="py-1 text-gray-500"><?= $new->create_utime ?></p>
                <div class="py-6">
                    <?= $new->short_description ?>
                </div>
                <a href="<?= Url::to(['/news/'.$new->id]) ?>">
                    <button type="button" class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-purple-700 hover:bg-purple-700 text-purple-700 hover:text-white font-normal py-2 px-4 rounded mb-2">Читати повнiстью</button>
                </a>
                <hr class="border-b border-gray-200">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
