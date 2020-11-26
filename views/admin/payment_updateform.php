<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-update-form mt-5">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '<div class="row"><div class="offset-sm-1 col-sm-2 mt-2">{label}</div><div class="col-sm-5 mt-2">{input}</div></div>',
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="form-group offset-sm-1 col-sm-2 mt-2">
            <?= Html::submitButton('<i class="fa fa-cog"></i> Update', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
