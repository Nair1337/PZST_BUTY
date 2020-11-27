<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cart-form">

    <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl('cart/update') . '?id=' . $model->id]); ?>
    <?= $form->field($model, 'quantity', ['enableClientValidation' => false,
        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.
            '<button class="btn btn-primary" style="border-radius: 0px 8px 8px 0px"><span class="fa fa-check"></span></button></span></div>',
    ])->textInput(['type' => 'number', 'style' => 'width: 32px; text-align: right'])->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>
