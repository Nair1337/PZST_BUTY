<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Users';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'id',
                'options' => [
                    'style' => 'width: 64px',
                ]
            ],
            'username',
            [
                'label' => 'Is admin?',
                'attribute' => 'is_admin',
                'format' => 'html',
                'options' => [
                    'style' => 'width: 50px',
                ],
                'value' => function ($data) {
                    if ($data->is_admin == 1) return '<i class="fa fa-check text-success"></i>';
                    else return '<i class="fa fa-times text-danger"></i>';
                }
            ],
            'first_name',
            'last_name',
            'email_address:email',
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($data) {
                    return '<a href="/admin/userupdate?id=' . $data->id . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                }
            ]
        ],
    ]); ?>
</div>
