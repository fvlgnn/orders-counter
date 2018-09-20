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

<div class="row">
	<div class="col-xs-6">
		<div class="form-group">
			<label>Date</label>
			<div class="form-group">
				<input type="text" class="form-control" id="selectDate" class="datepicker" value="<?= $date ?>" placeholder="Date">
			</div>
		</div>
	</div>
    <div class="col-xs-6">
		<div class="form-group">
			<label>Shift</label>
			<div class="form-group">
				<select class="form-control" id="selectShift">
					<?php for($i=1; $i<=2; $i++): ?>
					<option value="<?= $i ?>" <?= ($i==$shift)?'selected':''?>>Shift <?= $i ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>
	</div>
</div>

<?php //var_dump($datedelay) ?>	

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
				<i class="fa fa-shopping-basket icoshow"></i>
			</button>
		</div> 
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
	var selectDate = $('#selectDate').val();
	var selectShift = $('#selectShift').val();
	var dataPost = el.data("action") + "&date=" + selectDate + "&shift=" + selectShift;
	console.log(dataPost);
	$.ajax({
		type: "POST",
		url: apiUrl,
        // data: el.data("action"),
        data: dataPost,
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
			console.log('data:', data);
			el.removeClass('disabled');
			el.find('.icoshow').show();
			el.find('.icohide').hide();
		}
	});
});
</script>
<script src="<?= base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script>
    jQuery(function($){
        $('#selectDate').datepicker({
			format: 'yyyy-mm-dd'
        }).on('changeDate', function(e) {
			$('.datepicker').hide();
            var selectDate = $('#selectDate').val();
            // console.log(selectDate);
            // var selectDate = e.date.toISOString().split('T')[0];
            // console.log(e);
		});
	});
	jQuery(function($){
        $('#selectShift').on('change', function(e) {
            var selectShift = $('#selectShift').val();
            // console.log(selectShift);
            // console.log(e);
        });
	});
</script>







