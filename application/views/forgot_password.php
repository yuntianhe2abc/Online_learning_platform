<!DOCTYPE html>
<html>
<head>
 <title>Complete User Registration and Login System in Codeigniter</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
 <div class="container">
  <br />
  <h3 align="center">Forgot Password</h3>
  <br />
  <div class="panel panel-default">
   <div class="panel-heading">Register</div>
   <div class="panel-body">
    <form method="post" action="<?php echo base_url(); ?>login/email">
     
     <div class="form-group">
      <label>Email Address</label>
      <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" />
      <span class="text-danger"><?php echo form_error('email'); ?></span>
     </div>
     
     <div class="form-group">
      <input type="submit" name="register" value="Send Token" class="btn btn-info" />
     </div>
    </form>
   </div>
  </div>
 </div>
</body>
</html>
