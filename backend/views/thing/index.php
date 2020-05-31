<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ThingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Things';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Thing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' =>'status',
                'value' =>function($model){
                    return $model->status;
                }
            ],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{myButton}','{view}','{update}','{delete}',  // the default buttons + your custom button
            //     'buttons' => [
            //         'myButton' => function($url, $model, $key)
            //         {     // render your custom button
            //             if($model->status==0)
            //                 return Html::a('active',['thing/status','id'=>$model->id] ,['class'=>'btn btn-success']);
                        
            //                 return Html::a('disactive',['thing/status','id'=>$model->id],['class'=>'btn btn-error']);
            //         },
                    
            //     ]
            // ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update} {delete} {myButton}',
                'buttons'=>[
                    'myButton'=>function($url,$model,$key){
                        return $model->status==0 ? Html::a('active',['thing/status','id'=>$model->id] ,['class'=>'btn btn-success']) :
                        Html::a('disactive',['thing/status','id'=>$model->id] ,['class'=>'btn btn-danger']);
                        
                    }    
                ],
            ],
        ],
    ]); ?>
</div>
