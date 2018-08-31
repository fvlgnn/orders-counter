<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="margin-top:10px"></div>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-user"></i> Profile
			</li>
			<li>
				<a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Back</a>
			</li>
		</ol>
	</div>
</div>
<!-- /.row -->
<?php // var_dump($set) ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-user fa-fw"></i> <?= isset($user)?$user->email:$pageTitle ?>
				</h3>
			</div>
			<div class="panel-body">
				<form id="profileForm" role="form" method="post" action="<?= current_url() ?>">
					<div class="form-group">
						<div class="col-lg-2">Email</div>
						<div class="col-lg-10">
							<input class="form-control" name="email" type="email" value="<?= isset($user)?$user->email:'' ?>" readonly=""  />
							<p class="help-block">&#160;</p>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-lg-2">Password <span id="message_match"></span></div>
						<div class="col-lg-10">
							<div class="row">
								<div class="col-lg-6">
									<input class="form-control" id="password" name="password" type="password" placeholder="Enter new password for change" />
								</div>
								<div class="col-lg-6">
									<input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm passoword" />
								</div>
							</div>
							<p class="help-block">&#160;</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">Type</div>
						<div class="col-lg-10">
							<input class="form-control" name="type_dummy" type="text" value="<?= $userTypeKeyVal[$user->type] ?>" readonly=""  />
							<input name="type" type="hidden" value="<?= $user->type ?>" />
							<p class="help-block">&#160;</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">Name</div>
						<div class="col-lg-10">
							<input class="form-control" name="name" type="text" value="<?= isset($user)?$user->name:'' ?>" required="" />
							<p class="help-block">&#160;</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">Surname</div>
						<div class="col-lg-10">
							<input class="form-control" name="surname" type="text" value="<?= isset($user)?$user->surname:'' ?>" required="" />
							<p class="help-block">&#160;</p>
						</div>
					</div>
					<div class="form-group"><div class="col-lg-12" style="margin:5px;"></div></div>
					<div class="form-group">
						<div class="col-lg-2">Action</div>
						<div class="col-lg-10">
						<button type="submit" name="postSubmit" value="true" class="btn btn-primary btn-block"><?= isset($user)?'Update':'Add' ?></button>
						</div>
					</div>

				</form>

				<script>
					$(document).ready(function() {
						$('#password, #confirm_password').on('keyup', function () {
							if ($('#password').val() == $('#confirm_password').val()) {
								$('#message_match').html('<i class="fa fa-check-circle"></i> Matching').css('color', '#3c763d');
								$('#password').parent().removeClass("has-error").addClass("has-success");
								$('#confirm_password').parent().removeClass("has-error").addClass("has-success");
							} 
							else {
								$('#message_match').html('<i class="fa fa-exclamation-circle"></i> Not Matching').css('color', '#a94442');
								$('#password').parent().removeClass("has-success").addClass("has-error");
								$('#confirm_password').parent().removeClass("has-success").addClass("has-error");
							}
							if ($('#password').val() === "" && $('#confirm_password').val() === "") {
								$('#message_match').html('').css('color', '#fff');
								$('#password').parent().removeClass("has-success has-error");
								$('#confirm_password').parent().removeClass("has-success has-error");
							}
						});
					});
				</script>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->

<div style="margin-bottom:10px"></div>






