<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Delivery methods';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Delivery method', ['/admin/deliverycreate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => [
                    'style' => 'width: 50px',
                ],

            ],
            'name',
            [
                'label' => 'Cost',
                'format' => ['decimal', 2],
                'attribute' => 'cost',
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($data) {
                    return
                        '<a href="/admin/deliveryupdate?id=' . $data->id . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '<a href="/admin/deliverydelete?id=' . $data->id . '" title="Delete" aria-label="Delete" data-pjax="0" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                },
                'options' => [
                    'style' => 'width: 50px',
                ]
            ],
        ],
    ]); ?>


</div>
