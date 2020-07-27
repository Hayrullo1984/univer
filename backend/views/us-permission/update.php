<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsPermission */

$this->title = 'Update Us Permission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Us Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
