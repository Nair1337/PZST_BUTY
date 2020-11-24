<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->textarea(['maxlength' => true])->label(false) ?>

    <?php
    $form->field($model, 'author_id')->hiddenInput(['value' => $userID])->label(false);
    $form->field($model, 'product_id')->hiddenInput(['value' => $productID])->label(false);
    ?>

    <div class="comment-form-group">
        <i class="fas fa-star" style="font-size: 38px; margin: 4px; color: #ecb753"></i>
        <?= $form->field($model, 'stars')->dropDownList(
            [
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5'
            ],
            [
                'class' => 'comment-form-stars'
            ]
        )->label(false) ?>
        <?= Html::submitButton('Comment', ['class' => 'btn btn-success comment-submit-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
