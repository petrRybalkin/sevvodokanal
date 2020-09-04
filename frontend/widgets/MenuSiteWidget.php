<?php


namespace frontend\widgets;

use common\models\Category;
use Yii;
use common\models\Page;
use yii\base\Widget;

class MenuSiteWidget extends Widget
{
    public function run()
    {
        $pages = Page::getMenus()->all();
        $infos = Page::getInfo()->all();
        $abouts = Page::getAbout()->all();
        return $this->render('menu-header', [
            'pages' => $pages,
            'infos' => $infos,
            'abouts' => $abouts,
        ]);
    }
}