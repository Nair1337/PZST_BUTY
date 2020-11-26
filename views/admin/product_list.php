<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Products';
$this->params['breadcrumbs'][] = ['label' => 'Admin Panel', 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Product', ['/admin/productcreate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'image',
                'format' => 'html',
                'label' => '',
                'value' => function ($data) {
                    return Html::img('../' . $data->picture_url,
                        ['width' => '96px']);
                },
                'contentOptions' => ['style' => 'width: 96px; padding: 0px; height: 96px'],
            ],
            'id',
            'name',
            [
                'label' => 'Price',
                'format' => ['decimal', 2],
                'attribute' => 'price',
            ],
            'description',
            'stock',
            [
                'label' => 'Tax Rate',
                'format' => 'raw',
                'attribute' => 'tax_rate',
                'value' => function ($data) {
                    return $data->tax_rate * 100;
                }

            ],
            'ean',
            [
                'label' => 'Weight',
                'format' => ['decimal', 2],
                'attribute' => 'weight',
            ],
            'warranty',
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($data) {
                    return
                    '<a href="/admin/productupdate?id=' . $data->id . '" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="/admin/productdelete?id=' . $data->id . '" title="Delete" aria-label="Delete" data-pjax="0" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>';
                },

            ],
        ],
    ]); ?>


</div>
