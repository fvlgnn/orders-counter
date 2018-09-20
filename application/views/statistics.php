<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if(empty($dayOrders)): ?>
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-exclamation-circle"></i> No details data for this day
</div>
<?php endif; ?>

<div style="margin-top:10px"></div>

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-bar-chart"></i> <?= $pageTitle ?>
            </li>
            <li>
                <a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </li>
		</ol>
	</div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <input type="text" id="selectDate" class="datepicker" placeholder="Select date fo details">
        </div>
	</div>
</div>

<?php if(!empty($dayOrders)): ?>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pie-chart"></i> <?= (isset($charTitle))?$charTitle:''; ?> Destinations</h3>
            </div>
            <div class="panel-body">
                <div id="morris-donut-chart"></div>
                <div class="text-right">
                    <a href="<?= base_url() . "settings/day_details/" . $day ?>">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart"></i> <?= (isset($charTitle))?$charTitle:''; ?> Products</h3>
            </div>
            <div class="panel-body">
                <div id="morris-bar-chart"></div>
                <div class="text-right">
                <a href="<?= base_url() . "settings/day_details/" . $day ?>">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(isset($orderDays)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-area-chart"></i> Last days statistics</h3>
            </div>
            <div class="panel-body">
                <div id="morris-line-chart"></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div style="margin-bottom:10px"><p>&#160;</p></div>

<!-- Morris Charts JavaScript -->
<script src="<?= base_url(); ?>assets/js/plugins/morris/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
<script>
$(function() {

    <?php if(isset($orderDays)): ?>
    Morris.Line({
        element: 'morris-line-chart',
        data: [
            <?php foreach($orderDays as $orderDay): ?>
            {
                day: '<?= $orderDay->date ?>',
                total: <?= $orderDay->ordersTotal ?>,
                takeIn: <?= $orderDay->ordersIn ?>,
                takeOut: <?= $orderDay->ordersOut ?>,
                shift1: <?= $orderDay->shift1 ?>,
                shift2: <?= $orderDay->shift2 ?>
            },
            <?php endforeach; ?>
        ],
        xkey: 'day',
        xLabels: 'day',
        ykeys: ['total', 'takeIn', 'takeOut', 'shift1', 'shift2'],
        labels: ['total', 'takeIn', 'takeOut', 'shift1', 'shift2'],
        resize: true
    });
    <?php endif; ?>

    <?php if(!empty($dayOrders)): ?>
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Table Service",
            value: <?= $dayOrders{0}->ordersIn ?>
        }, {
            label: "Take Away",
            value: <?= $dayOrders{0}->ordersOut ?>
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [
            <?php foreach($dayOrders{1} as $dayOrder): ?>
            {
                item: '<?= ($dayOrder->destination==0)?"S":"A" ?><?= ($dayOrder->shift==1)?"1":"2" ?>.<?= $dayOrder->name ?>',
                total: <?= $dayOrder->total ?>
            },
            <?php endforeach; ?>
            ],
        xkey: 'item',
        ykeys: ['total'],
        labels: ['total'],
        barRatio: 0.4,
        xLabelAngle: 30,
        gridTextSize: 12,
        hideHover: 'auto',
        resize: true,
    });
    <?php endif; ?>

});
</script>

<script src="<?= base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script>
    jQuery(function($){
        $('#selectDate').datepicker({
            format: 'yyyy-mm-dd',
        }).on('changeDate', function(e) {
            var selectDate = $('#selectDate').val()
            console.log(selectDate);
            // var selectDate = e.date.toISOString().split('T')[0];
            // console.log(e);  
            window.location.href = '<?= base_url() . "statistics/" ?>' + selectDate;

        });
    });
</script>
