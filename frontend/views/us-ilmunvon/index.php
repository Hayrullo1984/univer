<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsIlmunvonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Ilmunvons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-ilmunvon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Ilmunvon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            'NAMEUNVON',
            'SHORTNAMEUNVON',
            'lANG.LANG',
            'aLIFBO.NAMEALIFBO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
