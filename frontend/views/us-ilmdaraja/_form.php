<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\UsLang;
use common\models\UsAlifbo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\UsIlmdaraja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="us-ilmdaraja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMEDARAJA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHORTNAMEDARAJA')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'IDLANG')->dropDownList(ArrayHelper::map(UsLang::find()->all(),'ID','LANG'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDALIFBO')->dropDownList(ArrayHelper::map(UsAlifbo::find()->all(),'ID','NAMEALIFBO'),['prompt'=>'tanlang']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
