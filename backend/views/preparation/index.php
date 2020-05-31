<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PreparationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preparations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preparation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Preparation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
</div>
