<?php
$this->load->view('template/header'); 

?>
<h1>Add New Course</h1>
<script src="jquery.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  


<?php echo form_open_multipart('course/save');?>
	<div class="col-md-7">
		<div class="form-group">
			<div class="row">
				<label class="col-md-3">Course Name</label>
				<div class="col-md-9">
					<input type="text" name="course_name" class="form-control">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3">Teacher</label>
				<div class="col-md-9">
					<input type="text" name="course_author" class="form-control">
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3">Description</label>
				<div class="col-md-9">
					<textarea name="course_description" class="form-control"></textarea>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3">Course Cover</label>
				<div class="col-md-9">
					<input type="file" name="course_image" class="form-control">
				</div>
				<div class="clearfix"></div>
			</div>
            
		</div>

        <div class="form-group">
        <div class="row">
				<label class="col-md-3">More files uploaded</label>
				<div class="col-md-9">
					<input type="file" name="pdfs[]" multiple="" class="form-control">
				</div>
				<div class="clearfix"></div>
		</div>
            
		</div>
        
		<input type="submit" name="submit" class="btn btn-info" value="Save Course">
	</div>
	<div class="clearfix"></div>
    <?php echo form_close(); ?>
<?php
$this->load->view('template/footer'); 
?>
