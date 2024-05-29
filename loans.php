 <?php include'lib/dbh.php'?>
 <div class="container py-5">
  <h1 class="text-center"><?php echo $title;?></h1>
  <div class="row">
  <div class="col-lg-12">
 

  <?php
          $qry = $conn->query("SELECT * FROM loan_types");
          while($row= $qry->fetch_assoc()):
          ?>
  <div class="col-lg-12  py-2">
 <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <img src="./public/img/cm.jpg" height="120rem;" class="img-responsive ">
        </div>
        <div class="col-lg-8">
        <h2 class="py-2"><b><?php echo ucwords($row['loanName']) ?></b></h2>
        <hr>
       <p class="lead italic"><?php echo $row['loanDesc'] ?></p>
    </div>
    </div>
    </div>
  
    <a href="index.php?page=apply_loan&id=<?php echo $row['id'];?>" class="btn btn-lg btn-flat btn-success"><i class="fa fa-pen-square"></i>Apply Loan</a>
 </div>
</div>
      <?php endwhile; ?>
    </div>
  </div>
</div>

