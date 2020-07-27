<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsPermission */

$this->title = 'Create Us Permission';
$this->params['breadcrumbs'][] = ['label' => 'Us Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
