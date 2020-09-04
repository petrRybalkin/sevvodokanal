<?php


namespace frontend\widgets;

use Yii;
use common\models\Article;
use yii\base\Widget;

class MainPageNewsWidget extends Widget
{
public function run()
{
    $news = Article::find()
        ->where(['active' => 1])
        ->orderBy('create_utime DESC')
        ->limit(5)
        ->all();

    $mainNew = true;

    return $this->render('main-page-news', [
        'mainNew' => $mainNew,
        'news' => $news,
    ]);
}
}
