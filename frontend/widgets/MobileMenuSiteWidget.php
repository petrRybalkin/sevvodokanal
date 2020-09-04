<?php


namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class MobileMenuSiteWidget extends Widget
{
    public function run()
    {
        $pages = Page::getMenus()->all();
        return $this->render('mobile-menu-header', [
            'pages' => $pages,
        ]);
    }
}