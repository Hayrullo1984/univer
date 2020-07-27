<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsAlifbo;
use common\models\UsLang;
use common\models\UsOrg;
use common\models\UsBulim;
/* @var $this yii\web\View */
/* @var $model common\models\UsLavozim */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="us-lavozim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDBULIM')->dropDownList(ArrayHelper::map(UsBulim::find()->all(),'ID','NAMEBULIM'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'NAMELAVOZIM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDLANG')->dropDownList(ArrayHelper::map(UsLang::find()->all(),'ID','LANG'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDALIFBO')->dropDownList(ArrayHelper::map(UsAlifbo::find()->all(),'ID','NAMEALIFBO'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDORG')->dropDownList(ArrayHelper::map(UsOrg::find()->all(),'ID','NAMEORG'),['prompt'=>'tanlang']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
