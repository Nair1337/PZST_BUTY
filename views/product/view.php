<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <div class="row" style="padding-left: 15px">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="row">
        <div class="col-6">
            <img src="<?= '../' . $model['picture_url'] ?>"/>
        </div>
        <div class="col-6">
            <?php
            $price_arr = explode(',', number_format($model->price, 2, ',', ' '));
            ?>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div>
                    <form name="add-to-cart" action="cartify">
                        <input type="hidden" value="<?= $model->id ?>" name="id"/>
                        <button class='btn btn-success btn-add-to-cart' type='submit'>
                            <i class="fas fa-cart-plus"></i>
                            Add to Cart
                        </button>
                    </form>
                </div>
            <?php } ?>
            <div>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'price',
                            'format' => 'html',
                            'value' => "<p class='detailed-view-price'>" . $price_arr[0] . "<sup>" . $price_arr[1] . "</sup>" . " €</p>",
                        ],
                        [
                            'attribute' => 'stock',
                            'format' => 'html',
                            'value' =>
                                intval($model->stock) > 50 ? '<p class="text-success"><span class="fa fa-thermometer-full text-success" /> Lots of</p>' :
                                    (intval($model->stock) > 20 ? '<p class="text-success"><span class="fa fa-thermometer-three-quarters" /> Plenty of</p>' :
                                        (intval($model->stock) > 5 ? '<p class="text-warning"><span class="fa fa-thermometer-half" /> Some left</p>' :
                                            (intval($model->stock) > 0 ? '<p class="text-danger"><span class="fa fa-thermometer-quarter" /> Few left</p>' :
                                                '<p class="text-muted"><span class="fa fa-thermometer-empty"/> None left</p>'))),
                        ],
                        [
                            'attribute' => 'tax_rate',
                            'value' => 100 * floatval($model->tax_rate) . '%',
                        ],
                        'ean',
                        //'picture_url:url',
                        [
                            'attribute' => 'weight',
                            'value' => $model->weight . ' kg',
                        ],
                        [
                            'attribute' => 'warranty',
                            'value' => $model->warranty . ' months',
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Description</h5>
            <p class="product-description"><?= $model->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Comments</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="comment-list-form">
                    <?=
                    $this->render('../comment/_form', [
                        'model' => new Comment(),
                        'productID' => $model->id,
                        'userID' => Yii::$app->user->identity->getId(),
                    ]);
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                    'class' => 'product-comment comment-list'
                ],
                'dataProvider' => new ActiveDataProvider([
                    'query' => Comment::find()->where(['product_id' => $model->id]),
                    'sort' => ['defaultOrder' => ['timestamp' => SORT_DESC]]
                ]),
                'emptyText' => 'No comments',
                'summary' => '',
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_detailed_comment', ['model' => $model]);
                },
            ]) ?>
        </div>
    </div>
</div>
