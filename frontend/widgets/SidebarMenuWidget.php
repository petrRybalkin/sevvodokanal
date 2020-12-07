<?php


namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class SidebarMenuWidget extends Widget
{
    public function run()
    {
        $pagesBefore = Page::getSidebarsBeforeNews()->all();
        $pagesAfter = Page::getSidebarsAfterNews()->all();
        return $this->render('menu-sidebar', [
            'pagesBefore' => $pagesBefore,
            'pagesAfter' => $pagesAfter,
        ]);
    }
}
