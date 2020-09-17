<?php

namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class FooterMenuRightWidget extends Widget
{
    public function run()
    {
        $footer_rights = Page::getFooterRight()->all();
        return $this->render('menu-footer-right', [
            'footer_rights' => $footer_rights,
        ]);
    }
}