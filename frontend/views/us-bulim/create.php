<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsBulim */

$this->title = 'Create Us Bulim';
$this->params['breadcrumbs'][] = ['label' => 'Us Bulims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-bulim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
