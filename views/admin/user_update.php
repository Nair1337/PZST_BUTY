<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Modify: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Users', 'url' => ['/admin/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <div class="mt-2">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('user_updateform', [
        'model' => $model,
    ]) ?>

</div>
