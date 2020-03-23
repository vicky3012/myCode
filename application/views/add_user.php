
<div class="col-md-12">
	  <div class="card">
		<div class="card-header card-header-primary">
		  <h4 class="card-title">User</h4>
		  <p class="card-category">Add User
		  <a class="float-right" href="<?php echo  base_url('list');?>"><i class="fa fa-arrow-left"></i> Back</a>
		  </p>
		</div>
		<div class="card-body">
		<div class="error text-danger">	</div>
		  <form action="<?php echo  base_url('save_user');?>" method="post">
			<div class="row">
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">First Name</label>
				  <input type="text" name="first_name" class="form-control">
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">Last Name</label>
				  <input type="text" class="form-control" name="last_name" >
				</div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">Email</label>
				  <input type="text" name="email" class="form-control">
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">Mobile</label>
				  <input type="text" class="form-control" name="mobile" >
				</div>
			  </div>
			</div>
			<div class="row">
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">Password</label>
				  <input type="password" name="password" class="form-control">
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="bmd-label-floating">Confirm Password</label>
				  <input type="password" class="form-control" name="confirm_password" >
				</div>
			  </div>
			</div>
			<button type="submit" class="btn btn-primary pull-right">Update Profile</button>
			<div class="clearfix"></div>
		  </form>
		</div>
	  </div>
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
						$('.error').hide();
						alert(data.message);
						setTimeout(function(){ window.location.replace("<?php echo base_url('list')?>"); }, 1000);						
					}else{
						$('.error').text(data.message);
						$('.error').fadeIn();
						setTimeout(function(){ $(".error").fadeOut(7000); }, 2000);
					}
				}
			});
		});
	});
</script> 