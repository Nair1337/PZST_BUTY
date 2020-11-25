<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Payment;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->title = 'Checkout - Payment';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => Yii::$app->urlManager->createUrl('cart/index')];
$this->params['breadcrumbs'][] = ['label' => 'Checkout - Delivery', 'url' => Yii::$app->urlManager->createUrl('cart/checkout')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-form">

    <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl('cart/checkoutfinish')]); ?>

    <?php
    $paymentModel = Payment::find()->all();
    $parr = [];
    foreach ($paymentModel as $pay) {
        $parr[$pay->id] = $pay->name;
    }
    ?>

    <?= $form->field($model, 'payment_id')->radioList($parr, ['encode' => false])->label('<h5>Payment method</h5>'); ?>

    <?= $form->field($model, 'delivery_id')->hiddenInput(['value' => $model->delivery_id])->label(false); ?>
    <?= $form->field($model, 'delivery_address')->hiddenInput(['value' => $model->delivery_address])->label(false); ?>

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px']) ?>
    <?php ActiveForm::end(); ?>

</div>
