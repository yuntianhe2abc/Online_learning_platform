<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
    <?php if(isset($_SESSION['pwd_reset_success'])){echo ($_SESSION['pwd_reset_success']);}?>
    <div class="container">
        <br />
        <h3 align="center">Login</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <?php
                if($this->session->flashdata('message'))
                {
                    echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
                }
                ?>
                    <?php echo form_open(base_url().'login/check_login'); ?>

                    <div class="form-group">
                        <label>Enter User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php if(get_cookie('username')!=NULL){
                            echo get_cookie('username');
                        } ?>" />
                        <span class="text-danger"><?php echo form_error('username'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>register">Register</a>
                    </div>
                    <div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
					
                        <a href="<?php echo site_url('login/forgot_password'); ?>">Forgot Passord</a>
					</div>  
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>
