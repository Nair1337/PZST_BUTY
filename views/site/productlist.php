<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="site-productsfilterpanel col-md-4">
    <p>Chuj</p>
    <p>Dupa</p>
    <p>Kurwa</p>
    <p>Cipa</p>
</div>
<div class="site-productslist col-md-8">
    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    ListView::widget([
        'dataProvider' => $listDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'row',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
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
    ]);
    ?>
</div>
</>
