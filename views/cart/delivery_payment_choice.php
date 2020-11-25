<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Delivery;
use app\models\Payment;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->title = 'Checkout - Delivery and Payment';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => Yii::$app->urlManager->createUrl('cart/index')];
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

    <?php
    $deliveryModel = Delivery::find()->all();
    $arr = [];
    foreach ($deliveryModel as $del) {
        $arr[$del->id] = $del->name . ' (<span class="detailed-view-price" style="font-size: 12px">' . $del->cost . ' €</span>)';
    }
    ?>

    <?= $form->field($model, 'delivery_id')->radioList($arr, ['encode' => false])->label('<h5 style="margin-top: 10px">Delivery method</h5>'); ?>
    <?= $form
        ->field($model, 'delivery_address', ['enableClientValidation' => false])
        ->textArea(['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Fill in if not pickup'])
        ->label('<h5 style="margin-top: 10px">Delivery address</h5>'); ?>
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px']) ?>
    <?php ActiveForm::end(); ?>

</div>
