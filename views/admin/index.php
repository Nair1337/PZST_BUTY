<?php

/* @var $this yii\web\View */

$this->title = 'Admin Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index container">
    <div class="body-content">
        <div class="row">
            <h1>Welcome to the admin panel</h1>
        </div>
        <div class="row">
            <p><a href="/admin/product"><i class="fa fa-wrench"></i> Manage products</a></p>
        </div>
        <div class="row">
            <p><a href="/admin/category"><i class="fa fa-wrench"></i> Manage categories</a></p>
        </div>
        <div class="row">
            <p><a href="/admin/payment"><i class="fa fa-wrench"></i> Manage payments</a></p>
        </div>
        <div class="row">
            <p><a href="/admin/delivery"><i class="fa fa-wrench"></i> Manage deliveries</a></p>
        </div>
        <div class="row">
            <p><a href="/admin/order"><i class="fa fa-wrench"></i> Manage orders</a></p>
        </div>
        <div class="row">
            <p><a href="/admin/user"><i class="fa fa-wrench"></i> Manage users</a></p>
        </div>
    </div>
</div>
