<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsUstamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Ustamas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-ustama-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Ustama', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            'lAVOZIM.NAMELAVOZIM',
            'SANA',
            'USTAMA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
