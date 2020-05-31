<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Thing */

$this->title = 'Create Thing';
$this->params['breadcrumbs'][] = ['label' => 'Things', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_cform', [
        'model' => $model,
        'dataProvider'=>$dataProvider,
        'searchModel' =>$searchModel,
    ]) ?>

</div>
