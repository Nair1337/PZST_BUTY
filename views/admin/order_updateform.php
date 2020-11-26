<?php

use app\models\OrderProduct;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Order;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-update-form mt-5">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '<div class="row"><div class="col-sm-2 mt-2">{label}</div><div class="col-sm-4 mt-2">{input}</div></div>',
        ]
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'payment')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $model->payment->name])->label('Payment') ?>

    <?= $form->field($model, 'delivery')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $model->delivery->name])->label('Delivery') ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $model->user->first_name . ' ' . $model->user->last_name])->label('Recipient') ?>

    <?= $form->field($model, 'delivery_address')->textArea(['maxlength' => true, 'disabled' => true, 'rows' => 4]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="form-group col-sm-2 mt-2">
            <?= Html::submitButton('<i class="fa fa-cog"></i> Update', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="row mt-4 mb-3">
        <div class="col-12">
            <h5>Items</h5>
        </div>
    </div>
        <?php
        $ordProducts = OrderProduct::find()->where(['order_id' => $model->id])->all();
        foreach($ordProducts as &$orp) {
            echo '<div class="row"><div class="col-12"><p>' . $orp->product->name . ' - ' . $orp->quantity . ' x</p></div></div>';
        }
        ?>
</div>
