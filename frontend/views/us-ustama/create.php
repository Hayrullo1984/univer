<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsUstama */

$this->title = 'Create Us Ustama';
$this->params['breadcrumbs'][] = ['label' => 'Us Ustamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-ustama-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
