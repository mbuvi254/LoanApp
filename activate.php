<?php
session_start();
include 'lib/meta.php';
include('lib/dbh.php');
if(isset($_GET['code'])){
	$user=$_GET['uid'];
	$code=$_GET['code'];

	$query=mysqli_query($conn,"select * from clients where id='$user'");
	$row=mysqli_fetch_array($query);

	if($row['code']==$code){
		//activate account
		mysqli_query($conn,"update clients set verify='1' where id='$user'");
		?>
<div class="container" style="padding-top:2rem;">
<div class="card">
<div class="card-body">
	<p class="text-center"><img src="public/img/cm.png" alt="avatar" class="img-circle center" style="border-radius:50% ;" height="100px;"></p>
<p class="h2 text-center"> Account Verified!</p>
<p><a href="login.php" class="btn btn-success btn-flat btn-block">Login Now</a></p>
</div>
</div>
</div>
		<?php
	}
	else{
		$_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
  		header('location:signup.php');
	}
	}
	else{
		header('location:index.php');
	}
?>