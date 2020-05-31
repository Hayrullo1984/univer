<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Food;
use yii\grid\GridView;
use conquer\select2\Select2Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Preparation */
/* @var $form yii\widgets\ActiveForm */

$query = new \yii\db\ActiveQuery(\common\models\Thing::className());
$data = $query->select([
    'thing.id as id',
    'CONCAT(thing.name) as text'
])->asArray()->all();
?>

<div class="preparation-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'food_id')->dropDownList(ArrayHelper::map(Food::find()->all(),'id','name'),['prompt'=>'Tanlang']) ?>

    <?= $form->field($model, 'thing_id')->widget(
    Select2Widget::className(),
    [
    'options'=>['placeholder'=>'Masalliq tanlang'],
    'multiple'=>true,

//        'items'=>ArrayHelper::map($data,'id','text','group'),
//        'items'=>ArrayHelper::map(\common\models\Teacher::find()->all(),'id','name_s','depart.name'),
        'ajax' => ['preparation/ajax'],

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

<!-- <div class="preparation-index">

    <h1>Tayyorlanishi</h1>
    

    <?php
     //echo GridView::widget([
        // 'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'food_id',
            // 'thing_id',

            // ['class' => 'yii\grid\ActionColumn'],
        // ],
    // ]); 
    ?>
</div> -->
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'food_id',
                'value' =>'food.name',
            ],
            // 'food_id',
            [
                'attribute' => 'thing_id',
                'value' => 'thing.name'
            ],
            
            // 'thing_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>