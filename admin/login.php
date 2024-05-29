<?php 
session_start();
include('library/dbh.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | LMS</title>
  

<?php include('./library/meta.php'); ?>
<?php 
if(isset($_SESSION['admin_id']))
header("location:index.php?page=home");

?>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./index.php">LMS </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in Adminstrator</p>

        <form id="login-form" >
              <div class="form-group">
                <input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password">
              </div>
              <center><button class="btn btn-block btn-flat col-md-12 btn-primary">Login</button></center>
            </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

</body>
<script>
  $('#login-form').submit(function(e){
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })
  $('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
</script> 
</html>