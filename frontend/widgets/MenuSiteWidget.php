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
        $model = new Page();
        //$pages = Page::getMenus()->all();
        //$infos = Page::getInfo()->all();
        //$abouts = Page::getAbout()->all();
        //$services = Page::getServices()->all();
        $pages = Page::getParents()->all();
        //$ids =
        //$childs = Page::getChild($id);
        return $this->render('menu-header', [
            'pages' => $pages,
            'model' => $model,
            //'infos' => $infos,
            //'abouts' => $abouts,
            //'services' => $services,
            //'subs' => $subs,
        ]);
    }
}
