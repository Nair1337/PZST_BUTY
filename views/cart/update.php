<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CartProduct */

$this->title = 'Change ' . $model->getProduct($model->product_id)->name . ' quantity';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Change ' . $model->getProduct($model->product_id)->name . ' quantity';
?>
<div class="cart-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
