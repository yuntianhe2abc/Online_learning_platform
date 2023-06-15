<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">Find Your Course</h2><br />
   
   <div class="form-group">
   <?php echo form_open('home/find_course'); ?>
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Course Name" class="form-control" />
	 <input type="hidden" id="course_id" value='0' >
	 <?php echo form_close(); ?>
    </div>
   </div>
   <br />
   <div id="result">   </div>
   <div id="load_data_message"></div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
  var limit = 3;
  var start = 0;
  var query = '';
  var action = 'inactive';
//  load_data();

 function load_data(query,limit,start)
 {

  $.ajax({
   url:"<?php echo base_url(); ?>home/find_course",
   method:"POST",
   cache:false,
   data:{query:query,limit:limit, start:start},
   success:function(data)
   {
    // $('#result').html(data);
    $('#result').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_data(query,limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#result").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_data($("#search_text").val(),limit, start);
   }, 1000);
  }
 });


 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search,limit,start);
  }
  else
  {
   load_data();
  }
 });
 
});
</script>




 <!-- Script -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

     // Initialize 
     $( "#search_text" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>home/course_name_auto_complete",
            type: 'GET',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#search_text').val(ui.item.label); // display the selected text
          $('#course_id').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
    </script>