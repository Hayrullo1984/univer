<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsRazryad */

$this->title = 'Create Us Razryad';
$this->params['breadcrumbs'][] = ['label' => 'Us Razryads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-razryad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
