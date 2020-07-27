<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UsLavozimSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-lavozim-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'IDMARKAZ') ?>

    <?= $form->field($model, 'IDBULIM') ?>

    <?= $form->field($model, 'NAMELAVOZIM') ?>

    <?= $form->field($model, 'IDLANG') ?>

    <?php // echo $form->field($model, 'IDALIFBO') ?>

    <?php // echo $form->field($model, 'IDORG') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
