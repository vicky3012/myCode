<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">	


<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<?php 
$session = $this->session->userdata('usersession');
if($session['id']){
	redirect('dashboard');
}
?>	
<style type="text/css">
    body {
		color: #fff;
		background: #63738a;
		font-family: 'Varela Round', sans-serif;
	}
	.modal-login {
		color: #636363;
		width: 350px;
	}
	.modal-login .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-login .modal-header {
		border-bottom: none;
		position: relative;
		justify-content: center;
	}
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
	.modal-login  .form-group {
		position: relative;
	}
	.modal-login i {
		position: absolute;
		left: 13px;
		top: 11px;
		font-size: 18px;
	}
	.modal-login .form-control {
		padding-left: 40px;
	}
	.modal-login .form-control:focus {
		border-color: #00ce81;
	}
	.modal-login .form-control, .modal-login .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-login .hint-text {
		text-align: center;
		padding-top: 10px;
	}
	.modal-login .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}
	.modal-login .btn {
		background: #00ce81;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #00bf78;
	}
	.modal-login .modal-footer {
		background: #ecf0f1;
		border-color: #dee4e7;
		text-align: center;
		margin: 0 -20px -20px;
		border-radius: 5px;
		font-size: 13px;
		justify-content: center;
	}
	.modal-login .modal-footer a {
		color: #999;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
	.modal-login a{
		color: #fff;
		
	}
</style>
</head>
<body>
<!-- Modal HTML -->
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h2>Login</h2>
			</div>
			<div class="modal-body">
			<p class="text-danger error"></p>
				<form action="<?php echo base_url('check_login')?>" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" name="username" placeholder="Username" required>
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" name="password" class="form-control" placeholder="Password" required="required">					
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>				
				
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
		</div>
		<br>
			<div class="text-center"><a href="<?php echo base_url('register')?>">Create an Account</a></div>

	</div>
	<script>
	$( document ).ready(function() {
		$("form").submit(function(e){
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			var url = form.attr('action');
			$.ajax({
				type: "POST",
				url: url,
				data: form.serialize(), // serializes the form's elements.
				success: function(data)
				{
					data = JSON.parse(data);
					if(data.status == 1){
						setTimeout(function(){ window.location.replace("<?php echo base_url('list')?>"); }, 1000);						
					}else{
						$('.error').text(data.message);
					}
				}
			});
		});
	});
</script>    

<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
</body>
</html>                      