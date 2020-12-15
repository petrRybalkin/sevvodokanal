<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
<!--                <div class="col-sm-6">-->
<!--                    <h1 class="m-0 text-dark">-->
<!--                        --><?php
////                        if (!is_null($this->title)) {
////                            echo \yii\helpers\Html::encode($this->title);
////                        } else {
////                            echo \yii\helpers\Inflector::camelize($this->context->id);
////                        }
//                        ?>
<!--                    </h1>-->
<!--                </div>--><!-- /.col -->
                <div class="col-sm-12">
                    <?//= \common\widgets\Alert::widget();?>
                    <?= \lavrentiev\widgets\toastr\NotificationFlash::widget() ?>
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <style>
        .pagination li{padding:1px 10px;border:1px solid #ccc;margin:5px 2px}
    </style>
</div>
