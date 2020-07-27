<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UsOylikoshSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-oylikosh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'IDRAZRYAD') ?>

    <?= $form->field($model, 'OKLAD') ?>

    <?= $form->field($model, 'SANA') ?>

    <?= $form->field($model, 'FOIZ') ?>

    <?php // echo $form->field($model, 'NEWOKLAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
