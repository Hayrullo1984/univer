<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsIlmdaraja */

$this->title = 'Create Us Ilmdaraja';
$this->params['breadcrumbs'][] = ['label' => 'Us Ilmdarajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-ilmdaraja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
