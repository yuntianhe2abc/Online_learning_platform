
<h1>User Details</h1>
<script src="jquery.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  


<?php if(isset($user_data)){?>
	
	<div class="form-group">
			<div class="row">
				<label class="col-md-2">Username</label>
				<div class="col-md-3">
				<input class="form-control" type="text" name="university" value=<?php echo $user_data->username?>  readonly>
			
				</div>
				
			</div>
		</div>
	
		<div class="form-group">
			<div class="row">
				<label class="col-md-2">Email</label>
				<div class="col-md-3">
				<input class="form-control" type="text" name="email" value=<?php echo $user_data->email?>  readonly>
					
				</div>
				
			</div>
		</div>
	
		<div class="form-group">
			<div class="row">
				<label class="col-md-2">Verification Status</label>
				<div class="col-md-3">
					
					<input class="form-control" type="text" name="email" value=<?php if($user_data->is_email_verified==1){echo 'Verified';}else{ echo 'Not Verified, Please verify email first';}?>  readonly>
				</div>
				
			</div>
		</div>
		<?php echo form_open('profile/update_profile');?>
		
	<div class="form-group">
			<div class="row">
				<label class="col-md-2">Study Level</label>
				<div class="col-md-3">
				<input class="form-control" type="text" name="study_level" value="<?php echo $user_data->study_level?>" >
				</div>
				
			</div>
		</div>
	
		<div class="form-group">
			<div class="row">
				<label class="col-md-2">University</label>
				<div class="col-md-3">
				<input class="form-control" type="text" name="university" value="<?php echo $user_data->university ?>" >
				</div>
				
			</div>
		</div>
	
		<div class="form-group">
			<div class="row">
				<label class="col-md-2">Major</label>
				<div class="col-md-3">
				<input class="form-control" type="text" name="major" value=<?php echo $user_data->major ?>  >
				</div>
				
			</div>
		</div>
		<input type="submit" name="submit" class="btn btn-info" value="Save Course">
	
	<?php echo form_close(); ?>
	</div>

<?php
}?>
	
<?php
$this->load->view('template/footer'); 
?>
