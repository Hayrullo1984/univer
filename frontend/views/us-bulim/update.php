<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsBulim */

$this->title = 'Update Us Bulim: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Us Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-bulim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
