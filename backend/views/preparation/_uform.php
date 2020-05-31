<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Food;
use conquer\select2\Select2Widget;
use common\models\Preparation;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Preparation */
/* @var $form yii\widgets\ActiveForm */
// $test = Preparation::find()->andWhere(['food_id'=>$model->food_id])->all();
// echo "<pre>";
// print_r($test);exit;
?>

<div class="preparation-form">

    <?php $form = ActiveForm::begin(); ?>

    <div>Ovqat nomi: <h3><?=$model->food->name?></h3></div>
    <?= $form->field($model, 'thing_id')->widget(
    Select2Widget::className(),
    [
    'options'=>[
        'placeholder'=>'Masalliq tanlang'
    ],
    // 'multiple'=>true,
    'items' => ArrayHelper::map(
        Preparation::find()
        ->andWhere(['food_id'=>$model->food_id])
        ->all(), 'id', 'thing.name'),
//        'items'=>ArrayHelper::map($data,'id','text','group'),
//        'items'=>ArrayHelper::map(\common\models\Teacher::find()->all(),'id','name_s','depart.name'),
        'ajax' => ['preparation/ajax'],
        'data' => $model->thing_id,

        'events' => [
            'select2:select' => "function(e) {
            console.log(e.target.value);
            }",
        ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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
