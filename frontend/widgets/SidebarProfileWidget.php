<?php


namespace frontend\widgets;

use Yii;
use common\models\Page;
use yii\base\Widget;

class SidebarProfileWidget extends Widget
{

    public function run()
    {

        return $this->render('profile-sidebar', [
            'number' => Yii::$app->request->get('id')
        ]);
    }
}