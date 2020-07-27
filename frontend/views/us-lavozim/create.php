<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsLavozim */

$this->title = 'Create Us Lavozim';
$this->params['breadcrumbs'][] = ['label' => 'Us Lavozims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-lavozim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
