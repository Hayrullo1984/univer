<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\UsLavozim;

/* @var $this yii\web\View */
/* @var $model common\models\UsUstama */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-ustama-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDLAVOZIM')->dropDownList(
    	ArrayHelper::map(UsLavozim::find()->all(),'ID','NAMELAVOZIM'),['prompt'=>'Tanlang'])
    	 ?>

    <?= $form->field($model, 'SANA')->widget(
    	DatePicker::className(),[
    	'dateFormat'=>'php:d.m.Y',
    	'clientOptions' => ['defaultDate' => date('y-m-d'),],'options'=>['class'=>'form-control']]
    ) ?>

    <?= $form->field($model, 'USTAMA')->textInput(['placeholder'=>'Foiz']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
