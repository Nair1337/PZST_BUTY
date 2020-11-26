<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use app\models\CartProduct;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    Yii::$app->name = 'BorkoShoeStore';
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top navbar-nice-color',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-pills navbar-right container-fluid navbar-container'],
        'items' => [
            //['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Products', 'url' => ['/product']],
            ['label' => 'About us', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                '</li>'
                . '<li class="nav-item login-button">'
                . '<a class="nav-link" href="/site/login"> '
                . '<i class="fa fa-sign-in-alt"></i> Login'
                . '</a></li>'
            ) : (
            Yii::$app->user->identity->is_admin ?
                (
                    '<li class="nav-item admin-button">'
                    . '<a class="nav-link" href="/admin/index"> '
                    . '<i class="fa fa-user-cog"></i> Admin Panel'
                    . '</a></li>'

                    . '<li class="nav-item">'
                    . '<a class="nav-link" href="/site/logout"> '
                    . '<i class="fa fa-sign-out-alt"></i> Logout <span style="font-size: 12px">(' . Yii::$app->user->identity->username . ')</span>'
                    . '</a></li>'
                ) : (
                '<li class="nav-item profile-button">'
                . '<a class="nav-link" href="/site/profile"> '
                . '<i class="fa fa-user"></i> Profile'
                . '</a></li>'

                . '<li class="nav-item cart-button">'
                . '<a class="nav-link" href="/cart/index"> '
                . '<i class="fa fa-shopping-cart"></i> Cart <span style="font-size: 12px">(' . CartProduct::getSummary(Yii::$app->user->identity->id) . ' €)</span>'

                . '<li class="nav-item">'
                . '<a class="nav-link" href="/site/logout"> '
                . '<i class="fa fa-sign-out-alt"></i> Logout <span style="font-size: 12px">(' . Yii::$app->user->identity->username . ')</span>'
                . '</a></li>'
            )
            )
        ],
    ]);
    NavBar::end();
    ?>
    q
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Anuśkiewicz, Adamski, Borkowski, Burzyński, I7G2S1 - PZST 2020</p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
