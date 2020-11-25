<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\Order;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <h3><?= 'Hi, ' . $model->username ?></h3>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => 'true']) ?>

    <?= $form->field($model, 'email_address')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo '<p><h5>Change password</h5></p>' ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php echo '<p><h5>Your orders</h5></p>' ?>

    <?php
    $orders = Order::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
    foreach($orders as &$ord) {
        echo '<a href=' . Yii::$app->urlManager->createUrl('site/orderview') . '?id=' . $ord->id . '><p>#' . $ord->id . ' - ' . $ord->order_date . ' - ' . $ord->total_value . '€ - Status: ' . $ord->status . '</p></a>';
    }
    ?>
</div>
