<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Modify: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Payment methods', 'url' => ['/admin/payment']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('payment_updateform', [
        'model' => $model,
    ]) ?>

</div>
