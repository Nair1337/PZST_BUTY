<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\CartProduct;
use app\models\Delivery;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->title = 'Checkout - Summary';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => Yii::$app->urlManager->createUrl('cart/index')];
$this->params['breadcrumbs'][] = ['label' => 'Checkout - Delivery and Payment', 'url' => Yii::$app->urlManager->createUrl('cart/checkout')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>

    <?php
    $model->total_value = CartProduct::getSummary(Yii::$app->user->identity->id) + $model->delivery->cost;
    ?>

    <div class="container row">
        <div class="col-md-3"><h5>Total order value:</h5></div>
        <div class="col-md-9 text-info"><?= $model->total_value ?> €</div>
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
    foreach (CartProduct::find()->where(['owner_id' => Yii::$app->user->identity->id])->all() as &$carPr) {
        echo '<div class="container row"><div class="offset-md-3 col-md-9 text-info">' . $carPr->getProduct($carPr->product_id)->name . ' - ' . $carPr->quantity . '</div></div>';
    }
    ?>

    <div class="container row">
        <div class="col-md-12 mt-3">
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl('cart/checkoutplaceorder')]); ?>
            <?= $form->field($model, 'delivery_id')->hiddenInput(['value' => $model->delivery_id])->label(false); ?>
            <?= $form->field($model, 'payment_id')->hiddenInput(['value' => $model->payment_id])->label(false); ?>
            <?= $form->field($model, 'delivery_address')->hiddenInput(['value' => $model->delivery_address])->label(false); ?>
            <?= Html::submitButton('Place order', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
