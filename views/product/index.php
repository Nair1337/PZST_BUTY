<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use app\models\Category;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $categoryModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="site-productsfilterpanel col-md-3">
        <h1>Categories</h1>
        <?= ListView::widget([
            'options' => [
                'tag' => 'div'
            ],
            'dataProvider' => new ActiveDataProvider([
                'query' => Category::find()
            ]),
            'summary' => '',
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_list_category', ['model' => $model]);
            },
        ]) ?>
    </div>
    <div class="site-productslist col-md-9">
        <div class="row">
            <div class="col-md-4">
                <h1 style="margin-bottom: 0px; margin-top: auto">Products</h1>
            </div>
            <div class="col-md-8" style="margin-bottom: 0px; margin-top: auto">
                <div>
                    <?php echo $this->render('/product/_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
                'id' => 'list-wrapper',
                'style' => 'padding: 15px'
            ],
            'layout' => "{pager}\n{items}\n</div><div class='row' style='padding: 15px'>{summary}",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_list_product', ['model' => $model]);
            },
            'itemOptions' => [
                'tag' => false,
            ],
            'pager' => [
                'firstPageLabel' => 'first',
                'lastPageLabel' => 'last',
                'nextPageLabel' => 'next',
                'prevPageLabel' => 'previous',
                'maxButtonCount' => 3,
            ],
        ]); ?>
    </div>
</div>
