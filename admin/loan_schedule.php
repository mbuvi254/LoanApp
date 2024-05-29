<?php
function calculateAndInsertLoanSchedule() {
    // Connect to your database (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "cyberma3_mbuvi";
    $password = "3030Mbuvi@";
    $dbname = "cyberma3_lms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get loan_id and loan_plan_id from form post
    $loanId = $_POST['loan_id'];
    $loanPlanId = $_POST['loan_plan_id'];

    // Fetch loan amount from loan_list table
    $loanSql = "SELECT * FROM loan_list WHERE id = $loanId";
    $loanResult = $conn->query($loanSql);

    if ($loanResult->num_rows > 0) {
        $loanRow = $loanResult->fetch_assoc();
        $loanAmount = $loanRow['loan_amount'];

        // Fetch loan plan details from the database
        $planSql = "SELECT * FROM loan_plan WHERE id = $loanPlanId";
        $planResult = $conn->query($planSql);

        if ($planResult->num_rows > 0) {
            $planRow = $planResult->fetch_assoc();

            // Extract relevant details
            $interestRate = $planRow['interest_percentage'] / 100;
            $penaltyRate = $planRow['penalty_rate'];
            $months = $planRow['months'];

            // Calculate monthly interest rate
            $monthlyInterestRate = $interestRate / 12;

            // Calculate monthly payment using the loan formula
            $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$months));

            // Initialize variables
            $remainingLoanAmount = $loanAmount;
            $totalPaid = 0;

            // Loop through each month to generate the loan schedule and insert into the loan_schedule table
            for ($month = 1; $month <= $months; $month++) {
                // Calculate interest for the month
                $monthlyInterest = $remainingLoanAmount * $monthlyInterestRate;

                // Calculate principal for the month
                $monthlyPrincipal = $monthlyPayment - $monthlyInterest;

                // Update remaining loan amount
                $remainingLoanAmount -= $monthlyPrincipal;

                // Update total amount paid
                $totalPaid += $monthlyPayment;

                // Insert record into loan_schedule table
                $insertSql = "INSERT INTO loan_schedule (loan_id, loan_plan_id, month, monthly_payment, monthly_interest, monthly_principal, remaining_loan_amount, total_paid)
                              VALUES ($loanId, $loanPlanId, $month, $monthlyPayment, $monthlyInterest, $monthlyPrincipal, $remainingLoanAmount, $totalPaid)";

                if ($conn->query($insertSql) !== TRUE) {
                    echo '<div class="alert alert-danger" role="alert">Error inserting record: ' . $conn->error . '</div>';
                }
            }

            // Update loan_list table to mark loan as released
            $updateLoanStatusSql = "UPDATE loan_list SET loan_status = 2 WHERE id = $loanId";

            if ($conn->query($updateLoanStatusSql) !== TRUE) {
                echo '<div class="alert alert-danger" role="alert">Error updating loan status: ' . $conn->error . '</div>';
            } else {
                // Close the database connection
                $conn->close();

                // Add Bootstrap styling for success alert
                echo '<div class="alert alert-success" role="alert">Loan schedule generated, inserted, and loan status updated successfully.</div>';
                header('Location:index.php?page=loan_schedule_list');
                
            } 
        } else {
            echo '<div class="alert alert-danger" role="alert">Loan plan not found</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Loan not found</div>';
    }
 header('Location:index.php?page=loan_schedule_list');
     //exit();
    // Close the database connection
    

}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    calculateAndInsertLoanSchedule();
}
?>

<?php include 'library/meta.php';?>
<?php include 'library/nav.php';?>
<?php include 'library/sidebar.php';?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
       
<div class="col-lg-12">
    <div class="card card-secondary">
        <div class="card-header">
             <h3 class="card-title">Release Loan</h3>
        </div>
        <div class="card-body">
   
        <form method="post">
            <div class="form-group">
                <label for="loan_id">Loan ID:</label>
                <input type="text" class="form-control" value="<?php echo $_GET['loan_id']?>" name="loan_id" required>
            </div>
            <div class="form-group">
                <label for="loan_plan_id">Loan Plan ID:</label>
                <input type="text" class="form-control" value="<?php echo $_GET['loan_plan']?>" name="loan_plan_id" required>
            </div>
        </div>
         <div class="card-footer">
                <button class="btn btn-primary btn-flat btn-block">Release Loan</button>
            <button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=approved_loans'">Approved Loans</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



      </div><!-- /.container-fluid -->
      <!-- /.content -->
    <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Menu</h5>
      <a href="ajax.php?action=logout">Logout</a>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <a href="ajax.php?action=logout">Logout</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;<?php echo date('Y') ?><a href=" ">LMS</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "./library/footer.php"?>
</body>
</html>
