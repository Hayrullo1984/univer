<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsLavozim */

$this->title = 'Update Us Lavozim: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Us Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-lavozim-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
