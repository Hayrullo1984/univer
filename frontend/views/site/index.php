<?php

use common\widgets\Alert;
use conquer\select2\Select2Widget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Oshxona';
?>
<h3>
Siz masalliq tanlang biz ovqat tavsiya e'tamiz
</h3>
<?php

if(isset($list)){

    if(!empty($list)){
            echo"<h1>Tamolar Ro'yxati</h1>";
        foreach ($list as $l){
            echo "<div class='alert alert-success'>$l</div>";
        }
        
    }else{
        echo "<div class='alert alert-danger'>Bunday taom topilmadi</div>";
    }
}   
   


?>
<div class="site-index">
<?php
if(Yii::$app->session->hasFlash('error')){
echo Alert::widget();
}
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'things')->widget(
    Select2Widget::className(),
    [
    'options'=>['placeholder'=>'Masalliq tanlang'],
    'multiple'=>true,

//        'items'=>ArrayHelper::map($data,'id','text','group'),
//        'items'=>ArrayHelper::map(\common\models\Teacher::find()->all(),'id','name_s','depart.name'),
        'ajax' => ['site/ajax'],

        'events' => [
            'select2:select' => "function(e) {
            console.log(e.target.value);
            }",
        ],

    ] )?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 
