<?php

namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class FooterMenuLeftWidget extends Widget
{
    public function run()
    {
        $footer_lefts = Page::getFooterLeft()->all();
        return $this->render('menu-footer-left', [
            'footer_lefts' => $footer_lefts,
        ]);
    }
}