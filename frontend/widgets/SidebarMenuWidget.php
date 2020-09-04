<?php


namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class SidebarMenuWidget extends Widget
{
    public function run()
    {
        $pages = Page::getSidebars()->all();
        return $this->render('menu-sidebar', [
            'pages' => $pages,
        ]);
    }
}