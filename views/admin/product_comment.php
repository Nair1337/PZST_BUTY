<?php

use yii\helpers\Html;

?>

    <article class="comment-list-item" data-key="<?= $model['id'] ?>">
        <div class="d-flex justify-content-between">
        <div>
            <h6 style="display: inline"><?= Html::encode($model->author->username); ?></h6>
            <?php
            $x = $model->stars;
            for($iter = 0; $iter < 5; $iter++) {
                if($x > 0) {
                    echo "<span class='fas fa-star' style='color: #ecb753' />";
                    $x--;
                }
                else {
                    echo "<span class='far fa-star' style='color: #ecb753' />";
                }
            }
            ?>
        </div>
        <div>
            <?= date("d-m-Y", strtotime(Html::encode($model->timestamp))) ?>
            <a href="/admin/commentdelete?id=<?= $model->id ?>&product_id=<?= $model->product_id ?>"><i class="fa fa-trash text-danger"></i></a>
        </div>
        </div>
        <p>
            <?= Html::encode($model['comment']); ?>
        </p>
    </article>
