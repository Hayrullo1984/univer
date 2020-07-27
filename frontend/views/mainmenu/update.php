<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mainmenu */

$this->title = 'Update Mainmenu: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Mainmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mainmenu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
