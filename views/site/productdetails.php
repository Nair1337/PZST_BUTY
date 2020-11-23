<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $item->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['productlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-productdetails">
    <figure>
        <img src="<?= "../" . $item->picture_url ?>" alt="<?= Html::encode($item->name); ?>" width="256"
             height="256">
    </figure>
    <h1 class="text-dark"><?= Html::encode($item->name); ?></h1>
    <h3 class="text-warning"><?= Html::encode($item->price); ?>€</h3>
    <h6 class="text-info"><?= Html::encode($item->description); ?></h6>
</>
