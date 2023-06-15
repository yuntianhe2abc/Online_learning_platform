<html>
        <head>
                <title>INFS3202 Demo</title>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
                <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        </head>
        <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a class="navbar-brand" href="#">INFS3202 Demo</a> -->
    
   
   
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul style="list-style-type:disc">
        <li >
            <a href="<?php echo base_url(); ?>profile">Profile</a>
        </li>
        <li >
            <a href="<?php echo base_url(); ?>course_recommendation">Course Recommendation</a>
        </li>
        <li>
        <a href="<?php echo base_url(); ?>home">Home</a>
        </li>
        <li>
        <a href="<?php echo base_url(); ?>course/add">Create Course</a>
        </li>
        <li>
        <a href="<?php echo base_url(); ?>shopping_cart">Check Shopping Cart</a>
        </li>
        <?php if(!$this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>login"> Login </a>
            
          </li>
          <li class="nav-item">
            
            <a href="<?php echo base_url(); ?>register"> Register </a>
          </li>
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
            <a href="<?php echo base_url(); ?>login/logout"> Logout </a>
           </li>
           <?php endif; ?>
    </ul>
    

    </div>
    
</nav>


