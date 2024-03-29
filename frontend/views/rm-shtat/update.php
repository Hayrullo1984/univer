<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RmShtat */

$this->title = 'Update Rm Shtat: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Rm Shtats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-shtat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
