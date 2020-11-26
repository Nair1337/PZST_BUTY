<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Modify: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Delivery methods', 'url' => ['/admin/delivery']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('delivery_updateform', [
        'model' => $model,
    ]) ?>

</div>
