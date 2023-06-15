<html>
	
    <head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    
		<?php if(isset($course_data)){ ?>
	

<div class="container">
	<img  src="<?php echo site_url('uploads/'.$course_data->course_image);?>">
  <h1><?php echo $course_data->course_name; ?></h1>  
	 
	<i>(Teacher: <?php echo $course_data->course_author;?>)</i></p>
	<p><?php echo $course_data->course_description;?></p>
	<?php 
   $count=0;
   $result = "";
   $rate=0;
   if(isset($course_rate)){$rate=intval($course_rate->rate);}
   for($i = 1; $i <= 5; $i++){
     
    if($rate > $count){
        $result .= "<span>&#x2605</span>";
    } else {
        $result .= "<span>&#x2606</span>";
    }
    $count++;
}?>
<h4>Course Rating: </br><?php echo $result?></h4>
   <i>Rated By <h2><?php if(isset($course_rate)){echo $course_rate->rate_count;} ?></h2> Students</i>
</div>


<?php }
?>
<div class="container">
  <?php echo form_open('shopping_cart/add_course');?>
    <div class="form-group">
     <input type="hidden" name="course_id" id="course_id" value=<?php echo $course_data->course_id; ?> />
     <input type="submit" name="add_cart" id="add_cart" class="btn btn-info" value="Add to Cart" />
    </div>
    <p><?php if($this->session->flashdata('success')!='')
{
	echo $this->session->flashdata('success');
}?></p>
	<?php echo form_close(); ?>
  </div>
<div>
<br />
  <h2 align="center">Comment</h2>
  <br />
  <div class="container">
  <?php echo form_open('',array('id'=>'comment_form'));?>
  <div> 
    <div class="form-group" id="rate_group">
     <label for="rate">Rate For Course</label>  <br />
    <select class="col-md-3" name="rate" id="rate">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <br />
    <br />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="course_id" id="course_id" value=<?php echo $course_data->course_id; ?> />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
	<?php echo form_close(); ?>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
</div>




  

    </body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"<?=base_url()?>courseDetails/add_comment",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({

   url:"<?php echo base_url(); ?>courseDetails/fetch_comments/<?php echo $course_data->course_id; ?>",
   method:"GET",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }
 
 
 
});

</script>