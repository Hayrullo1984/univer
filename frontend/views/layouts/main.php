<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->beginContent("@frontend/views/layouts/base.php");
?>



   <?=$this->render('_navbar')?>
    <div class="container h-100">

   <?=$this->render('_sidebar')?>
   <?=$this->render('_exmenu')?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
<?=$this->render('_footer')?>
    </div>
<?php
$this->endContent();
?>

