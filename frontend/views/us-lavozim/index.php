<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsLavozimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Lavozims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-lavozim-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Lavozim', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            // 'IDMARKAZ',
            'bULIM.NAMEBULIM',
            'NAMELAVOZIM',
            'lANG.LANG',
            'aLIFBO.NAMEALIFBO',
            'oRG.NAMEORG',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
