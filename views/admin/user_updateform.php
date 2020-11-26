<?php

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

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'is_admin')->checkbox(['label' => null])->label("Is admin?") ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <div class="row">
        <div class="form-group col-sm-2 mt-2">
            <?= Html::submitButton('<i class="fa fa-cog"></i> Update', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="row mt-4 mb-3">
        <div class="col-12">
            <h5>Orders</h5>
        </div>
    </div>
        <?php
        $orders = Order::find()->where(['user_id' => $model->id])->all();
        foreach($orders as &$ord) {
            echo '<div class="row"><div class="col-12"><a href=' . Yii::$app->urlManager->createUrl('/admin/orderview') . '?id=' . $ord->id . '><p>#' . $ord->id . ' - ' . $ord->order_date . ' - ' . $ord->total_value . '€ - Status: ' . $ord->status . '</p></a></div></div>';
        }
        ?>
</div>
