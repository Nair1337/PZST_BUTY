<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\CartProduct;
use app\models\OrderProduct;
use app\models\Delivery;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div>
    <div class="container row">
        <div class="col-md-3"><h5>Total order value:</h5></div>
        <div class="col-md-9 text-info"><?= $model->getValue() ?> €</div>
    </div>
    <div class="container row">
        <div class="col-md-3"><h5>Delivery method:</h5></div>
        <div class="col-md-9 text-info"><?= $model->delivery->name ?></div>
    </div>
    <div class="container row">
        <div class="col-md-3"><h5>Payment method:</h5></div>
        <div class="col-md-9 text-info"><?= $model->payment->name ?></div>
    </div>
    <div class="container row">
        <div class="col-md-3"><h5>Delivery address:</h5></div>
        <div class="col-md-9 text-info"><?= $model->delivery_address ?></div>
    </div>
    <div class="container row">
        <div class="col-md-3"><h5>Ordered Products:</h5></div>
    </div>
    <?php
    foreach (OrderProduct::find()->where(['order_id' => $model->id])->all() as &$carPr) {
        echo '<div class="container row"><div class="offset-md-4 col-md-8 text-info">' . $carPr->product->name . ' - ' . $carPr->quantity . '</div></div>';
    }
    ?>
</div>
