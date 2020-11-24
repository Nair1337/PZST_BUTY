<?php

use yii\helpers\Html;

?>

    <article class="category-list-item col-12" data-key="<?= $model['id'] ?>">
        <a href="<?= '/product?category=' . $model['name'] ?>">
        <h5 class="text-dark"><?= Html::encode($model['name']); ?></h5>
        </a>
    </article>
