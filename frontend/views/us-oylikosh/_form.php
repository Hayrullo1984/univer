<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsRazryad;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\UsOylikosh */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="us-oylikosh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDRAZRYAD')->dropDownList(ArrayHelper::map(UsRazryad::find()->all(),'ID','RAZRYAD','SANA'),['prompt'=>'tanlang']) ?>

    <?php
     // $form->field($model, 'OKLAD')->textInput()
      ?>

    <?= $form->field($model, 'SANA')->widget(DatePicker::className(),[
        'dateFormat'=>'php:d.m.Y',
        'clientOptions' => ['defaultDate' =>''],'options'=>['class'=>'form-control']]) ?>

    <?= $form->field($model, 'FOIZ')->textInput() ?>
    

    <?= $form->field($model, 'NEWOKLAD')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
