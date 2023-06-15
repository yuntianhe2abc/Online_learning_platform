<html>
<header>
    <h1> Course recommendation Based on User similarity and Couse Ratings</h1>
 
  </header>
</body>
<?php 
if(isset($course)){
    foreach($course as $n)
		{
			?>
			<a >
				<div class="row">
					<div class="col-md-3">
						<img  width="128" height="128" src="<?php echo site_url('uploads/thumbnails/'.$n->course_image);?>">
					</div>
					<div class="col-md-6">
                        <h4 class="text-info"><?php echo $n->course_name; ?></h4>  
                       
						<i>(Teacher: <?php echo $n->course_author;?>)</i></p>
                        <a href="<?php echo site_url('courseDetails/details/'.$n->course_id); ?>">Course Details</a>
                        
                        
                    
					</div>
					<div class="col-md-3">
                        <h4>Recommendation Score:</h4>
                        <h2><?php echo $scores[$n->course_id]?></h2>
					</div>
				</div>
			</a></br></br>
           
			<?php
		}
    }
?>
</body>
</html>
<script>
$(document).ready(function(){
 
 $('#cart').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"<?=base_url()?>course/add_comment",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#add_cart_message').html(data.error);
    }
   }
  })
 });