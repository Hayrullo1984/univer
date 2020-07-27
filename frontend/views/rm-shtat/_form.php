<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UsBudkont;
use common\models\UsBulim;
use common\models\UsLavozim;
use common\models\UsIlmunvon;
use common\models\UsIlmdaraja;
use common\models\UsRazryad;
use common\models\UsOrg;
use common\mdoels\UsLang;
use common\models\UsAlifbo;
use common\models\UsUstama;


/* @var $this yii\web\View */
/* @var $model common\models\RmShtat */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="rm-shtat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IDBUDKONT')->dropDownList(ArrayHelper::map(UsBudkont::find()->all(),'ID','NAMEBUDKONT'),['prompt'=>"tanlang"]) ?>

    <?= $form->field($model, 'IDBULUM')->dropDownList(ArrayHelper::map(UsBulim::find()->all(),'ID','NAMEBULIM'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDLAVOZIM')->dropDownList(ArrayHelper::map(UsLavozim::find()->all(),'ID','NAMELAVOZIM'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDUNVON')->dropDownList(ArrayHelper::map(UsIlmunvon::find()->all(),'ID','NAMEUNVON'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDDARAJA')->dropDownList(ArrayHelper::map(UsIlmdaraja::find()->all(),'ID','NAMEDARAJA'),['prompt'=>'tanlang'])?>

    <?= $form->field($model, 'BIRLIKSONI')->textInput() ?>

    <?= $form->field($model, 'IDRAZRYAD')->dropDownList(ArrayHelper::map(UsRazryad::find()->all(),'ID','RAZRYAD','SANA'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'IDUSTAMA')->dropDownList(ArrayHelper::map(UsUstama::find()->all(),'ID','USTAMA','SANA'),['prompt'=>'tanlang']) ?>

    <?= $form->field($model, 'JAMI')->textInput() ?>

    <?= $form->field($model, 'IZOH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'YNL')->textInput() ?>

    <?= $form->field($model, 'IDORG')->dropDownList(ArrayHelper::map(UsOrg::find()->all(),'ID','NAMEORG'),['prompt'=>'tanlang']) ?>

    <?php
     // $form->field($model, 'IDUSER')->textInput() 
     ?>

    <?php
     // $form->field($model, 'INSDATE')->textInput(['maxlength' => true]) 
     ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
