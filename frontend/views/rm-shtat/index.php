<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\widgets\Bulim;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RmShtatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rm Shtats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-shtat-index" >

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
   
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rm Shtat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   <?php
   ?>
        <?=Bulim::widget([
            'models'=>$models,
            'budkont'=>$budkont,
            'bulim'=>$bulim,
            'lavozim'=>$lavozim,
            'unvon'=>$unvon,
            'daraja'=>$daraja,
            'org'=>$org,
            'razryad'=>$razryad,
            'v_shtats' => $v_shtats,
            'yil' => $yil,
        ])?>
   
    <?php
    // echo GridView::widget([
    //     'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'ID',
            // 'bUDKONT.NAMEBUDKONT',
            // 'IDMARKAZ',
            // 'bULIM.NAMEBULIM',
            // 'lAVOZIM.NAMELAVOZIM',
            // 'IDUNVON',
            //'IDDARAJA',
            //'BIRLIKSONI',
            //'IDRAZRYAD',
            //'USTAMA',
            //'JAMI',
            //'IZOH',
            //'YNL',
            //'IDORG',
            //'IDUSER',
            //'INSDATE',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]);
     ?>
</div>
