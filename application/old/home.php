
<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

    <form class="form-inline my-2 my-lg-0">
      <?php echo form_open('home/find_course'); ?>
      <input class="form-control mr-sm-2" type="search" id="search_text" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> </button>
      <?php echo form_close(); ?>

<div class="container">
<div class="collapse" id="collapseExample">
  <div class="card card-body" id="result">

  </div>
</div>
<script>
    $(document).ready(function(){
    load_data();
        function load_data(query){
            $.ajax({
            url:"<?php echo base_url(); ?>home/find_course",
            method:"GET",
            data:{query:query},
            success:function(response){
                $('#result').html("");
                if (response == "" ) {
                    $('#result').html(response);
                }else{
                    var obj = JSON.parse(response);
                    if(obj.length>0){
                        var items=[];
                        $.each(obj, function(i,val){
                            items.push($("<h4>").text(val.course_name));
                            
                            items.push($( '<img width="160" height="120" src="<?php echo site_url('uploads/thumbnails/'.$n->course_image);?>" class="img-responsive" /><br />  '));
                            
                            items.push($("<i>").text(val.course_author ));
                            items.push($("<p>").text(val.course_name));
                            items.push($( '<?php echo substr($n->course_description,0,200).'...';?><br /> '));
                            items.push($( '<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  <br />   '));
                            items.push($( '<a href="<?php echo site_url('home/detail/'.$n->course_id)?>">View Details</a>'));
                    });
                    $('#result').append.apply($('#result'), items);         
                    }else{
                    $('#result').html("Not Found!");
                    }; 
                };
            }
        });
        }
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != ''){
            load_data(search);
        }else{
            load_data();
        }
        });
    });
</script>
<style>
button.btn.collapsed:before 
{ 
    content:'Show Result' ; 
}
 button.btn:before
{
    content:'Hide Result' ;
}
</style>
<?php 
if(isset($course)){
    foreach($course as $n)
		{
			?>
			<a class="news-list" href="<?php echo site_url('home/detail/'.$n->course_id)?>">
				<div class="row">
					<div class="col-md-3">
						<img class="img-fluid" src="<?php echo site_url('uploads/thumbnails/'.$n->course_image);?>">
					</div>
					<div class="col-md-9">
						<h1><?php echo substr($n->course_name,0,35).'..';?></h1>
						<p><?php echo substr($n->course_description,0,200).'...';?>
							<i>(Author: <?php echo $n->course_author;?>)</i></p>
						
					</div>
				</div>
			</a>
			<?php
		}
    }
?>


