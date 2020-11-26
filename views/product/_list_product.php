<?php

use yii\helpers\Html;

?>

    <article class="product-list-item col-sm-4" data-key="<?= $model['id'] ?>">
        <a style="text-decoration: none" href="<?= '/product/view?id=' . $model['id'] ?>">
        <figure>
            <img style="margin: auto; display: block" src="<?= "../" . $model['picture_url'] ?>" alt="<?= Html::encode($model['name']); ?>" width="128"
                 height="128">
        </figure>
        <h3 class="text-dark"><?= Html::encode($model['name']); ?></h3>
        <h6 class="detailed-view-price"><?= Html::encode(number_format($model['price'], 2, ',', ' ')); ?> €</h6>
        </a>
    </article>
