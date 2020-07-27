<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\UsRazryad */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="us-razryad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RAZRYAD')->textInput() ?>

    <?= $form->field($model, 'SANA')->widget(DatePicker::className(),[
    	'dateFormat'=>'php:d.m.Y',
    	'clientOptions' => ['defaultDate' => date('y-m-d'),],'options'=>['class'=>'form-control']]) ?>

    <?= $form->field($model, 'KOEF')->textInput() ?>

    <?= $form->field($model, 'OKLAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
