<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Modify order #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Orders', 'url' => ['/admin/order']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-update">

    <div class="mt-2">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('order_updateform', [
        'model' => $model,
    ]) ?>

</div>
