<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RmShtat */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Rm Shtats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rm-shtat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'ID',
            'bUDKONT.NAMEBUDKONT',
            // 'mARKAZ',
            'bULIM.NAMEBULIM',
            'lAVOZIM.NAMELAVOZIM',
            'uNVON.NAMEUNVON',
            'dARAJA.NAMEDARAJA',
            'BIRLIKSONI',
            'rAZRYAD.RAZRYAD',
            'uSTAMA.USTAMA',
            'JAMI',
            'IZOH',
            'YNL',
            'oRG.NAMEORG',
            // 'uSER.LOGIN',
            'INSDATE',
        ],
    ]) ?>

</div>
