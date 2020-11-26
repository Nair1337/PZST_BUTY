<?php

use app\models\Delivery;
use app\models\Payment;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Orders';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'id',
                'options' => [
                    'style' => 'width: 64px',
                ]
            ],
            [
                'label' => 'User',
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],
            [
                'label' => 'Value',
                'attribute' => 'total_value',
                'format' => 'html',
                'value' => function ($data) {
                    return '<span class="detailed-view-price">' . number_format($data->total_value, 2, ',', ' ') . ' €</span>';
                }
            ],
            [
                'label' => 'Payment',
                'attribute' => 'payment_id',
                'value' => function ($data) {
                    return Payment::find()->where(['id' => $data->payment_id])->one()->name;
                }
            ],
            [
                'label' => 'Delivery',
                'attribute' => 'delivery_id',
                'value' => function ($data) {
                    return Delivery::find()->where(['id' => $data->delivery_id])->one()->name;
                }
            ],
            'status',
            'order_date',
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($data) {
                    return '<a href="/admin/orderupdate?id=' . $data->id . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '<a href="/admin/orderdelete?id=' . $data->id . '" title="Delete" aria-label="Delete" data-pjax="0" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                }
            ]
        ],
    ]); ?>
</div>
