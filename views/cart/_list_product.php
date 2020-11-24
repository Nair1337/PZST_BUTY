<?php

use yii\helpers\Html;

?>

<article class="product-list-item col-12" data-key="<?= $model['id'] ?>">
    <div class="row">
        <?php
        $productModel = $model->getProduct($model['product_id']);
        ?>
        <div class="col-4">
            <figure>
                <img style="margin: auto; display: block" src="<?= "../" . $productModel['picture_url'] ?>"
                     alt="<?= Html::encode($productModel['name']); ?>" width="64"
                     height="64">
            </figure>
        </div>
        <div class="col-2">
            <h6><?= Html::encode($model['owner_id']); ?></h6>
        </div>
        <div class="col-2">
            <h6><?= Html::encode($model['product_id']); ?></h6>
        </div>
        <div class="col-4">
            <h6><?= Html::encode($model['quantity']); ?></h6>
        </div>
    </div>
</article>
