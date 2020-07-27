<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsOylikosh */

$this->title = 'Create Us Oylikosh';
$this->params['breadcrumbs'][] = ['label' => 'Us Oylikoshes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-oylikosh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
