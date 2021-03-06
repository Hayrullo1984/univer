<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsRazryad */

$this->title = 'Update Us Razryad: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Us Razryads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-razryad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
