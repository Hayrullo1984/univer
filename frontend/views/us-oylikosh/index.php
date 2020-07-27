<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsOylikoshSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Oylikoshes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-oylikosh-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Oylikosh', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            'rAZRYAD.RAZRYAD',
            'OKLAD',
            'SANA',
            'FOIZ',
            //'NEWOKLAD',
            //'YNL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
