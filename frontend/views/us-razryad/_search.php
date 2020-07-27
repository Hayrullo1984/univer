<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UsRazryadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-razryad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'RAZRYAD') ?>

    <?= $form->field($model, 'SANA') ?>

    <?= $form->field($model, 'KOEF') ?>

    <?= $form->field($model, 'OKLAD') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
