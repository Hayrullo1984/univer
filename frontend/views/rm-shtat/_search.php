<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RmShtatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rm-shtat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'IDBUDKONT') ?>

    <?= $form->field($model, 'IDMARKAZ') ?>

    <?= $form->field($model, 'IDBULUM') ?>

    <?= $form->field($model, 'IDLAVOZIM') ?>

    <?php // echo $form->field($model, 'IDUNVON') ?>

    <?php // echo $form->field($model, 'IDDARAJA') ?>

    <?php // echo $form->field($model, 'BIRLIKSONI') ?>

    <?php // echo $form->field($model, 'IDRAZRYAD') ?>

    <?php // echo $form->field($model, 'USTAMA') ?>

    <?php // echo $form->field($model, 'JAMI') ?>

    <?php // echo $form->field($model, 'IZOH') ?>

    <?php // echo $form->field($model, 'YNL') ?>

    <?php // echo $form->field($model, 'IDORG') ?>

    <?php // echo $form->field($model, 'IDUSER') ?>

    <?php // echo $form->field($model, 'INSDATE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
