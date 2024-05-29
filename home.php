<?php include 'lib/dbh.php' ?>
<main>
<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="public/img/cm.jpg" alt="" width="72" height="57">
    <h2 class="display-5 fw-bold">Welcome!<?php echo ucwords($_SESSION['user_firstname'].' '.$_SESSION['user_lastname']) ?></h2>
    <div class="col-lg-6 mx-auto">
      <h4 class="bold">Loans Applications:<?php echo $conn->query("SELECT * FROM loan_list  where loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <h4 class="text-warning">Pending Loans:<?php $status=0;
      echo $conn->query("SELECT * FROM loan_list  where loan_status=$status AND  loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <h4 class="text-primary">Approved Loans:<?php $status=1;
      echo $conn->query("SELECT * FROM loan_list  where loan_status=$status AND  loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <h4 class="text-success ">Released Loans:<?php $status=2;
      echo $conn->query("SELECT * FROM loan_list  where loan_status=$status AND  loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <h4 class="text-danger ">Denied Loans:<?php $status=4;
      echo $conn->query("SELECT * FROM loan_list  where loan_status=$status AND  loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <h4 class="text-success ">Completed Loans:<?php $status=3;
      echo $conn->query("SELECT * FROM loan_list  where loan_status=$status AND  loan_client = {$_SESSION['user_id']}")->num_rows; ?></h4>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="./index.php?page=loan_applications" type="button" class="btn btn-primary btn-lg px-4 gap-3">APPLICATIONS</a>
        <a href="./index.php?page=loans" class="btn btn-warning btn-lg px-4 gap-3">LOANS</a>
      </div>
    </div>
  </div>

</main>