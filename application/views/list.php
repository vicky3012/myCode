<link rel="stylesheet"  href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
<script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="col-md-12">
  <div class="card">
	<div class="card-header card-header-primary">
	  <h4 class="card-title ">User List</h4>
	  <p class="card-category"> All User list you can view all details
	  <a class="float-right" href="<?php echo  base_url('add_user');?>"><i class="fa fa-plus"></i> Add User</a>
	  </p>	
	  
	</div>
	<div class="card-body">
	  <div class="table-responsive">	  
		<table class="table table-striped " id="myTable">
		  <thead class=" text-primary">
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Action</th>
		  </thead>
		  <tbody>
		  <?php if(isset($user_list) && !empty($user_list)){
			  $i = 1;
			  foreach($user_list as $user_listi){?>
			<tr>
			  <td>
				<?=$i;?>
			  </td>
			  <td>
				<?php echo ucfirst($user_listi->first_name) .' '. ucfirst($user_listi->last_name);?>
			  </td>
			  <td>
				<?php echo $user_listi->email;?>
			  </td>
			  <td>
				<?php echo $user_listi->mobile;?>
			  </td><td>
				<a href="#"><i class="fa fa-edit"></i></a>
			  </td>
			</tr>
		  <?php }}?>
		  </tbody>
		</table>
	   </div>
	</div>
  </div>
</div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>