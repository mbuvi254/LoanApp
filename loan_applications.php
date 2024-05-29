 <?php include'lib/dbh.php'?>
 <div class="container py-5">
  <h1 class="text-center h1"><b><?php echo $title;?></b></h1>
  <div class="row">
  <div class="col-lg-12">
 <?php
  $qry = $conn->query("SELECT * ,loan_list.id as lid  FROM loan_list JOIN loan_types ON loan_list.loan_type=loan_types.id JOIN loan_plan ON loan_list.loan_plan=loan_plan.id WHERE loan_list.loan_client={$_SESSION['user_id']} ORDER BY(loan_list.id) DESC ");
  while($row= $qry->fetch_assoc()):
          ?>
  <div class="col-lg-12  survey-item py-2">
 <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <img src="./public/img/cm.jpg"  class="img-responsive img-fluid" height="50rem;">
        </div>
        <div class="col-lg-8">
        <h2 class=" py-2"><b><?php echo ucwords($row['loanName']) ?></b></h2>
        <hr>
        <h2 class="lead py-2">Ksh.<?php echo number_format($row['loan_amount']) ?> </h2>
        <hr>
       <h3 class="lead italic"><b>Loan Plan</b></h3>
       <p class="lead italic"><?php echo $row['months'] ?> Months</p>
       <p class="lead italic"><?php echo $row['interest_percentage'] ?> % Interest Percent</p>
       <p class="lead italic">Ksh.<?php echo number_format($row['penalty_rate']) ?>  Penalty Rate</p>
       <hr>
    </div>
    </div>
    </div>
<?php if($row['loan_status'] == 0): ?>
<a href="#" class="btn btn-lg btn-flat btn-warning">Pending Approval</a>
<?php elseif($row['loan_status'] == 1): ?>
<a href="#" class="btn btn-lg btn-flat btn-info">Approved</a>
<?php elseif($row['loan_status'] == 2): ?>
 <a href="index.php?page=loan_schedule&id=<?php echo $row['lid'];?>" class="btn btn-lg btn-flat btn-success">Released</a>
<?php elseif($row['loan_status'] == 3): ?>

 <a href="#" class="btn btn-lg btn-flat btn-succes">Completed</a>
  <?php elseif($row['loan_status'] == 4): ?>

   <a href="#" class="btn btn-lg btn-flat btn-danger">Denied</a>
                <?php endif; ?>
 
 </div>
</div>
      <?php endwhile; ?>

