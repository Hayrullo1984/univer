 <?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
    NavBar::begin([
        'brandLabel' => "&#9776; Menu",
        'brandUrl' => "javascript:void(0)",
        'options' => [
            'class' => 'navbar-expand-lg navbar-fixed-top navbar-light bg-light shadow-sm',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label'=>'Logout (' . Yii::$app->user->identity->username . ')',
            'url'=>['/site/logout'],
            'linkOptions'=>['data-method'=>'post'],
    ];
    }
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav ml-auto',
            'style'=>'overflow: auto;white-space: nowrap;',

        ],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
