<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RmShtat */

$this->title = 'Create Rm Shtat';
$this->params['breadcrumbs'][] = ['label' => 'Rm Shtats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-shtat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
