<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MainmenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mainmenu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NAMEMMENU') ?>

    <?= $form->field($model, 'POSITION') ?>

    <?= $form->field($model, 'IDLANG') ?>

    <?= $form->field($model, 'IDALIFBO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
