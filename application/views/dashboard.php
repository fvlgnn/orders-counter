<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="margin-top:10px"></div>

<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-dashboard"></i> <?= $pageTitle ?>
			</li>
		</ol>
	</div>
</div>
<!-- /.row -->

<?php //var_dump($datedelay) ?>	

<!-- <div class="row">
    <div class="col-xs-6">
		<div class="form-group">
			<label>Take In</label>
			<div class="input-group">
				<span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button></span>
				<input class="form-control" type="text" name="takein">
				<span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
			</div>
		</div>
	</div>
    <div class="col-xs-6">
		<div class="form-group">
			<label>Take Out</label>
			<div class="input-group">
				<span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button></span>
				<input class="form-control" type="text" name="takeout">
				<span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
			</div>
		</div>
	</div>
</div> -->

<div class="row">
	<div class="col-lg-12">
		<?php // var_dump($items) ?>
		<?php $i=0 ?>
		<?php foreach($items as $item): ?>
			<?php if($i!=$item->type): ?>
			<div class="page-header">
                <h2><?= $item->typeName ?></h2>
			</div>
			<?php endif; ?>
		<div class="btn-group horizontal-btn">
			<button data-action="item=<?= $item->id ?>&destination=0" class="btn btn-primary btn-lg submit">
				<i style="display: none;" class="fa fa-cog fa-spin icohide"></i>
				<i class="fa fa-cutlery icoshow"></i>
			</button>
			<button class="btn btn-primary btn-lg disabled"><?= $item->name ?></button>
			<button data-action="item=<?= $item->id ?>&destination=1" class="btn btn-primary btn-lg submit">
				<i style="display: none;" class="fa fa-cog fa-spin icohide"></i>
				<i class="fa fa-shopping-basket icoshow"></i> <!-- fa-home -->
			</button>
		</div> 
		<!-- <button type="button" data-action="item=<?= $item->id ?>" class="btn btn-lg btn-primary horizontal-btn submit">
			<i style="display: none; padding:0 20px;" class="icohide fa fa-cog fa-spin"></i>
			<span class="icoshow"><?= $item->name ?></span>
		</button> -->
		<?php $i = $item->type ?>
		<?php endforeach; ?>
	</div>
</div>
<!-- /.row -->

<div style="margin-bottom:10px"><p>&#160;</p></div>

<script type="text/javascript">
$(".submit").click(function() {
	var el = $(this);
	var apiUrl = '<?= base_url() . "dashboard/submit"; ?>';
	$.ajax({
		type: "POST",
		url: apiUrl,
        data: el.data("action"),
		ContentType: "application/x-www-form-urlencoded",
		cache: false,
		beforeSend: function(){
			el.addClass('disabled');
			el.find('.icoshow').hide();
			el.find('.icohide').show();
		},
		error: function(msg){
			console.log('error:', msg);
			alert("Error, please view console log.");
			location.reload();
		},
		statusCode: {
			401: function () {
				alert("Unauthorized!");
				location.reload();
			}
		},
		success: function(data){
			// $('#autoupdate').load('<?= base_url() . "dashboard/autoupdate/".end($this->uri->segments); ?>');
			console.log('data:', el.data("action"));
			el.removeClass('disabled');
			el.find('.icoshow').show();
			el.find('.icohide').hide();
		}
	});
});
</script>

<!-- <script type="text/javascript">
	setInterval(function() {
		location.reload();
	}, 300000);
</script> -->






