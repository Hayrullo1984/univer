<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsIlmunvon */

$this->title = 'Create Us Ilmunvon';
$this->params['breadcrumbs'][] = ['label' => 'Us Ilmunvons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-ilmunvon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
