<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Add Product';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Products', 'url' => ['/admin/product']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('product_form', [
        'model' => $model,
    ]) ?>

</div>
