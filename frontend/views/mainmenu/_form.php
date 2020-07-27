<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsLang;
use common\models\UsAlifbo;
/* @var $this yii\web\View */
/* @var $model common\models\Mainmenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mainmenu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMEMMENU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POSITION')->textInput() ?>

    <?= $form->field($model, 'IDLANG')->dropDownList(ArrayHelper::map(UsLang::find()->all(),'ID','LANG'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDALIFBO')->dropDownList(ArrayHelper::map(UsAlifbo::find()->all(),'ID','NAMEALIFBO'),['prompt'=>'tanlang']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
