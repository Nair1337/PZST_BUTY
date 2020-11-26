<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-add-form mt-5">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '<div class="row"><div class="offset-sm-1 col-sm-2 mt-2">{label}</div><div class="col-sm-5 mt-2">{input}</div></div>',
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01', 'placeholder' => '€'])->label('Price') ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => 3]) ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number', 'placeholder' => '#'])->label('Stock') ?>

    <?= $form->field($model, 'tax_rate')->textInput(['type' => 'number', 'placeholder' => '%'])->label('VAT') ?>

    <?= $form->field($model, 'ean')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['type' => 'number', 'step' => '0.01', 'placeholder' => 'kilograms'])->label('Weight') ?>

    <?= $form->field($model, 'warranty')->textInput(['type' => 'number', 'placeholder' => 'months'])->label('Warranty') ?>

    <?= $form->field($model, 'imageFile')->fileInput()->label('Picture file') ?>

    <?php
    $categories = Category::find()->all();
    $carr = [];
    foreach($categories as &$cat) {
        $carr[$cat->id] = $cat->name;
    }
    ?>

    <?= $form->field($model, 'categories')->checkboxList($carr, ['separator' => '</br>']) ?>

    <div class="row">
        <div class="form-group offset-sm-1 col-sm-2 mt-2">
            <?= Html::submitButton('<i class="fa fa-plus"></i> Add', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
