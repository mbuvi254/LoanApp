<?php session_start(); 
if(!isset($_SESSION['user_id']))
header('location:login.php'); 
?>
<?php include 'lib/meta.php';?>
<?php include 'lib/nav.php';?>
<?php 
if(!isset($_SESSION['user_id']))
header('location:login.php'); ?>
<div class="container">
<?php 
  $page = isset($_GET['page']) ? $_GET['page'] : 'home';
  include $page.'.php';
  ?>
</div>
<div class="container">
<p class="text-center"><a href="#">LMS © 2019-<?php echo date("Y");?></a></p>
</div>
<?php include 'lib/footer.php'?>