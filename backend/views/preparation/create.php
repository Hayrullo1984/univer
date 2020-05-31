<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Preparation */

$this->title = 'Create Preparation';
$this->params['breadcrumbs'][] = ['label' => 'Preparations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_cform', [
        'model' => $model,
        'dataProvider'=>$dataProvider,
        'searchModel' =>$searchModel,

    ]) ?>

</div>
