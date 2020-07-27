<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsOylikosh */

$this->title = 'Update Us Oylikosh: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Us Oylikoshes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="us-oylikosh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
