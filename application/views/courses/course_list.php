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
					<div class="col-md-9">
                        <h4 class="text-info"><?php echo $n->course_name; ?></h4>  
                       
						<i>(Teacher: <?php echo $n->course_author;?>)</i></p>
                        <a href="<?php echo site_url('courseDetails/details/'.$n->course_id); ?>">Course Details</a>
                        
					</div>
					
				</div>
			</a></br></br>
           
			<?php
		}
    }
?>
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