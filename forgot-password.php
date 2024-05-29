<?php
session_start();
include 'lib/meta.php';
include('lib/db.php');
if(isset($_SESSION['user_id'])){
header('location:index.php?page=home');
}
?>
  <body>
    <!-- (A) PASSWORD RESET FORM -->
    <div class="container" style="padding-top:5rem;">
  <div class="card">
  <div id="login_form" class="card-body login-card-body">
    <p class="text-center"><img src="public/img/cm.png" alt="avatar" class="img-circle center" style="border-radius:50% ;" height="100px;"></p>
    <h2><center><span class="glyphicon glyphicon-lock"></span> Password Reset</center></h2>
    <form method="post" target="_self">
     <label>Enter Email</label>
      <input type="email" name="email" class="form-control" required value=""/><hr>
      <input type="submit" class="btn btn-primary btn-block" value="Reset Password"/>
      <a href="login.php" class="btn btn-success btn-flat btn-block">Login Now</a>
    </form>
  </div>
</div>

    <!-- (B) PROCESS PASSWORD RESET REQUEST -->
    <?php
    if (isset($_POST["email"])) {
      // (B1) CONNECT TO DATABASE
      require "lib/db.php";

      // (B2) CHECK IF VALID USER
      $stmt = $pdo->prepare("SELECT * FROM `clients` WHERE `email`=?");
      $stmt->execute([$_POST["email"]]);
      $clients = $stmt->fetch();
      $result = is_array($clients)
              ? ""
              : $_POST["email"] . " is not registered." ;

      // (B3) CHECK PREVIOUS REQUEST (PREVENT SPAM)
      if ($result == "") {
        $stmt = $pdo->prepare("SELECT * FROM `client_reset` WHERE `client_id`=?");
        $stmt->execute([$clients["id"]]);
        $request = $stmt->fetch();
        $now = strtotime("now");
        if (is_array($request)) {
          $expire = strtotime($request["reset_time"]) + $prvalid;
          if ($now < $expire) { $result = "Please try again later"; }
        }
      }

      // (B4) CHECKS OK - CREATE NEW RESET REQUEST
      if ($result == "") {
        // RANDOM HASH
        $hash = md5($clients["email"] . $now);

        // DATABASE ENTRY
        $stmt = $pdo->prepare("REPLACE INTO `client_reset` VALUES (?,?,?)");
        $stmt->execute([$clients["id"], $hash, date("Y-m-d H:i:s")]);

        // SEND EMAIL - CHANGE TO YOUR OWN!
        $from = "cybermaisha@gmail.com";
        $subject = "Cybermaisha Survey Password reset";
        $header = implode("\r\n", [
          "From: $from",
          "MIME-Version: 1.0",
          "Content-type: text/html; charset=utf-8"
        ]);
        $link = "https://www.chama.cybermaisha.co.ke/password-reset.php?i=".$clients["id"]."&h=".$hash;
        $message = "<a href='$link'>Click here to reset password</a>";
        if (!@mail($lients["email"], $subject, $message, $header)) {
          $result = "Failed to send email!";
        }
      }

      // (B5) RESULTS
      if ($result=="") { $result = "Email has been sent - Please click on the link in the email to confirm."; }
      echo "<div>$result</div>";
    }
    ?>
  </body>
</html>
