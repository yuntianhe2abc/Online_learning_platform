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
    <form method="post" action="<?php echo base_url(); ?>login/reset_password">
     
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" />
      <span class="text-danger"><?php echo form_error('password'); ?></span>
     </div>
     <div class="form-group">
      <label>Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" value="<?php echo set_value('password'); ?>" />
      <span class="text-danger"><?php echo form_error('password'); ?></span>
     </div>
     <div class="form-group">
        <input  name="email" value="<?php echo $email ?>">
      <input type="submit" name="reset" value="Reset" class="btn btn-info" />
     </div>
    </form>
   </div>
  </div>
 </div>
</body>
</html>
