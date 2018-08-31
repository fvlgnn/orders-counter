<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="margin-top:10px"></div>

<?php if(isset($datatable)): ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Back</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <?= $pageSubtitle ?>
                </li>
            </ol>
        </div>
    </div>
    <!-- Table -->
    <?= $datatable->output; ?>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-cogs"></i> <?= $pageTitle ?>
                </li>
                <li>
                    <a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Back</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= base_url() . "settings/orders"?>" type="button" class="btn btn-lg btn-primary btn-block"><i class="fa fa-shopping-cart"></i>  Orders</a>
            <a href="<?= base_url() . "settings/items"?>" type="button" class="btn btn-lg btn-primary btn-block"><i class="fa fa-beer"></i> Items</a>
            <a href="<?= base_url() . "settings/types"?>" type="button" class="btn btn-lg btn-primary btn-block"><i class="fa fa-tags"></i> Types</a>
            <a href="<?= base_url() . "settings/users"?>" type="button" class="btn btn-lg btn-primary btn-block"><i class="fa fa-users"></i> Users</a>
        </div>
    </div>
<?php endif; ?>

<div style="margin-bottom:10px">&#160;</div>