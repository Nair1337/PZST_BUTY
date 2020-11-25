<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\CartProduct;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CartProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $priceSummary = '<span class="detailed-view-price">' . CartProduct::getSummary(Yii::$app->user->identity->id) . ' €</span>';
    ?>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => CartProduct::find()->where(['owner_id' => Yii::$app->user->identity->id]),
        ]),
        'showFooter' => true,
        'footerRowOptions' => ['style' => 'font-weight: bold', 'class' => 'text-center'],
        'columns' => [
            [
                'attribute' => 'image',
                'format' => 'html',
                'label' => '',
                'value' => function ($data) {
                    $productObj = CartProduct::getProduct($data->product_id);
                    return Html::img('../' . $productObj->picture_url,
                        ['width' => '96px']);
                },
                'contentOptions' => ['style' => 'width: 96px; padding: 0px; height: 96px'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center'],
                'value' => function ($data) {
                    return CartProduct::getProduct($data->product_id)->name;
                },
                'label' => 'Product',
                'contentOptions' => ['class' => 'text-center align-middle'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'price',
                'headerOptions' => ['class' => 'text-center'],
                'footer' => $priceSummary,
                'value' => function ($data) {
                    return CartProduct::getProduct($data->product_id)->price . ' €';
                },
                'label' => 'Price',
                'contentOptions' => ['class' => 'text-center align-middle detailed-view-price', 'style' => 'width: 128px'],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'quantity',
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center'],
                'value' => function ($data) {
                    return $this->render('_form', [
                        'model' => $data,
                    ]);
                },
                'label' => '#',
                'contentOptions' => ['class' => 'text-center align-middle', 'style' => 'width: 128px'],
            ],
            [
                'attribute' => 'action_column',
                'label' => '',
                'format' => 'raw',
                'value' => function ($data) {
                    return
                        '<form action="/cart/delete?id=' . $data->id . '" method="post">
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<button value="submit" style="all: unset; cursor: pointer">
<div style="margin: 0">
<i class="fa fa-times fa-1x text-danger"></i>
</div>' . '
</button>
</form>';
                },
                'contentOptions' => ['class' => 'text-center align-middle', 'style' => 'width: 96px'],
            ],
        ],
    ]); ?>
    <form type="get" action="checkout">
        <button class="btn btn-success" type="submit">Checkout</button>
    </form>
</div>
