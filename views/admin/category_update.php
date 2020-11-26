<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Modify: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Categories', 'url' => ['/admin/category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('category_updateform', [
        'model' => $model,
    ]) ?>

</div>
