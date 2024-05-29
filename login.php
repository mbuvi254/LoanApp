<?php
session_start();
include 'lib/meta.php';
include('lib/dbh.php');
if(isset($_SESSION['user_id'])){
header('location:index.php?page=home'); } ?>
<div class="container" style="padding-top:5rem;">
<div class="card">
<div id="login_form" class="card-body login-card-body">
<p class="text-center"><img src="public/img/cm.jpg" alt="avatar" class="img-circle center" style="border-radius:50% ;" height="100px;"></p>
<h2><center><span class="glyphicon glyphicon-lock"></span>LMS Login</center></h2>
<div style="height: 15px;"></div>
<?php
if(isset($_SESSION['log_msg'])){ ?>
<div style="height: 30px;"></div>
<div class="alert alert-danger">
<span><center>
<?php echo $_SESSION['log_msg'];
unset($_SESSION['log_msg']); ?>
</center></span>
</div>
<?php } ?>
<hr>
<form method="POST" action="log.php">
Email: <input type="text" name="email" class="form-control" required>
<div style="height: 10px;"></div>   
Password: <input type="password" name="password" class="form-control" required> 
<div style="height: 10px;"></div>
<div class="card-footer">
<button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-log-in"></span> Login</button> 
<a href="signup.php" class="btn btn-success btn-flat btn-block">Sign up</a><br>
<!---<a href="forgot-password.php"><b class="h5">Forgot Password</b></a>--->
</div>
</form>
</div>
</div>
</div>
<p class="text-center"><a href="#">lms © 2019-<?php echo date("Y");?></a></p>

<?php include 'lib/footer.php'?>