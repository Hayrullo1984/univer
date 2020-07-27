<?php

use yii\helpers\Html;
use yii\bootsrtap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\UsUstamaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-ustama-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'IDLAVOZIM') ?>

    <?= $form->field($model, 'SANA') ?>

    <?= $form->field($model, 'USTAMA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
