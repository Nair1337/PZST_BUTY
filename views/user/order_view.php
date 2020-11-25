<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\CartProduct;
use app\models\Delivery;
use app\models\OrderProduct;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->title = 'Order #' . $model->id ;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => Yii::$app->urlManager->createUrl('site/profile')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>

    <div class="container row">
        <div class="offset-md-1 col-md-3">Order ID:</div>
        <div class="col-md-8 text-info">#<?= $model->id ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Order Date:</div>
        <div class="col-md-8 text-info"><?= $model->order_date ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Total order value:</div>
        <div class="col-md-8 text-info"><?= $model->total_value ?> €</div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Delivery:</div>
        <div class="col-md-8 text-info"><?= $model->delivery->name ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Payment:</div>
        <div class="col-md-8 text-info"><?= $model->payment->name ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Delivery address:</div>
        <div class="col-md-8 text-info"><?= $model->delivery_address ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Order status:</div>
        <div class="col-md-8 text-info"><?= $model->status ?></div>
    </div>
    <div class="container row">
        <div class="offset-md-1 col-md-3">Ordered Products:</div>
    </div>
    <?php
    foreach (OrderProduct::find()->where(['order_id' => $model->id])->all() as &$orPr) {
        echo '<div class="container row"><div class="offset-md-4 col-md-8 text-info">' . $orPr->product->name . ' - ' . $orPr->quantity . '</div></div>';
    }
    ?>
</div>
