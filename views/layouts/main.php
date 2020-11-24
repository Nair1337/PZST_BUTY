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
            'class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right container-fluid navbar-container'],
        'items' => [
            //['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Products', 'url' => ['/product']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            [
                'label' => '<i class="fa fa-shopping-cart"></i> Cart <span style="font-size: 12px">(' . CartProduct::getSummary(Yii::$app->user->identity->id) . '€)</span>',
                'encode' => false,
                'url' => Yii::$app->urlManager->createUrl('cart/index'),
                'visible' => !Yii::$app->user->isGuest,
                'options' => ['class' => 'cart-button']
            ],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login'], 'options' => ['class' => 'login-button']]
            ) : (
                '<li class="nav-item">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link nav-link', 'style' => 'border: 0']
                )
                . Html::endForm()
                . '</li>'
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
