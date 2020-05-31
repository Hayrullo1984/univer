<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Preparation */

$this->title = 'Update Preparation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Preparations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="preparation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_uform', [
        'model' => $model,
        'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]) ?>

</div>
