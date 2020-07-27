<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsPermission */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Us Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Us Permission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager'=>[
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'action_name',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
