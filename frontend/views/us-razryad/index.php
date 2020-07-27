<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsRazryadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Razryads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-razryad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Razryad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            'RAZRYAD',
            'SANA',
            'KOEF',
            'OKLAD',
            'YNL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
