<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row mt-3 mb-3">
        <div class="col-12">
            <h4>We've created this app!</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="d-flex flex-row-reverse">
                <figure>
                    <img src="/imgs/RA.jpg" alt="Rafał Adamski"/>
                </figure>
            </div>
            <div class="d-flex flex-row-reverse">
                <h5>Rafał Adamski</h5>
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex flex-row">
                <figure>
                    <img src="/imgs/PA.jpg" alt="Piotr Anuśkiewicz"/>
                </figure>
            </div>
            <div class="d-flex flex-row">
                <h5>Piotr Anuskiewicz</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="d-flex flex-row-reverse">
                <figure>
                    <img src="/imgs/KB.png" alt="Barol Korkowski" width="200" height="250"/>
                </figure>
            </div>
            <div class="d-flex flex-row-reverse">
                <h5>Karol Borkowski</h5>
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex flex-row">
                <figure>
                    <img src="/imgs/WB.jpg" alt="Wojciech Burzyński"/>
                </figure>
            </div>
            <div class="d-flex flex-row">
                <h5>Wojciech Burzyński</h5>
            </div>
        </div>
    </div>
</div>
