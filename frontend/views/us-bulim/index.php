<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsBulimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Bulims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-bulim-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Bulim', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager'=>[
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'IDORG',
            'IDMARKAZ',
            'NAMEBULIM',
            'IDLANG',
            //'IDALIFBO',

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
</div>
